<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class Utils
{
    public static function formatTanggalIndo($tanggal)
    {
        $date = Carbon::create($tanggal);
        $formattedDate = $date->locale('id')->translatedFormat('j F Y');
        return $formattedDate;
    }
    public static function formatTanggalLaporan($tanggal)
    {
        if ($tanggal == null) {
            return '-';
        }
        return date('d/m/Y', strtotime($tanggal)) ?? '-';
    }
    public static function formatTanggal($tanggal)
    {
        if ($tanggal == null) {
            return '-';
        }
        return date('d-m-Y', strtotime($tanggal)) ?? '-';
    }
    public static function rupiah($nominal, $decimals = 2)
    {
        return 'Rp ' . number_format((float) $nominal, $decimals, ',', '.');
    }

    public static function decimal($nominal = 0, $decimals = 2)
    {
        $parse = number_format((float) $nominal, $decimals, ',', '.');
        $expParse = explode(',', $parse);
        $decimal = end($expParse);
        $nominal = array_shift($expParse);
        return $nominal . '<small>' . ",$decimal" . '</small>';
    }

    public static function formatSlug($string)
    {
        $string = preg_replace('/[ -]+/', '_', $string);
        $string = preg_replace('/([a-z])([A-Z])/', '$1_$2', $string);
        return strtolower($string);
    }

    public static function sum($items = [], $operator = '+')
    {
        if (empty($items)) {
            return 0;
        }

        if (count($items) === 1) {
            return $items[0];
        }

        // Join the items with the specified operator
        $expression = implode(" $operator ", $items);

        // Use Laravel's DB::raw to sum the expression
        $result = DB::select(DB::raw("SELECT SUM($expression) AS sum"))[0]->sum;

        return is_numeric($result) ? (float) $result : $result;
    }

    public static function forceDownload($filename = '', $data = null, $setMime = false)
    {
        if (empty($filename)) {
            return response('Filename is required', 400);
        }

        // Handle file download if no data provided
        if ($data === null) {
            // Check if the file exists and is readable
            if (!File::exists($filename)) {
                return response('File not found', 404);
            }

            // Get file mime type if needed
            $mimeType = $setMime ? File::mimeType($filename) : 'application/octet-stream';
            $filePath = realpath($filename);

            // Return a file download response
            return response()->download($filePath, basename($filename), [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
            ]);
        }

        // Handle data stream download
        $mimeType = $setMime ? 'text/plain' : 'application/octet-stream';  // Set default MIME type
        $filesize = strlen($data);
        $filename = str_replace(['/', '  '], '-', $filename);  // Sanitize filename

        // Return a raw response with the file data
        return response($data, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length' => $filesize,
            'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
        ]);
    }
}
