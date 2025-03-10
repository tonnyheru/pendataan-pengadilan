<?php

namespace App\Http\Controllers;

use App\DataTables\PemohonDataTable;
use App\Helpers\PermissionCommon;
use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PemohonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemohonDataTable $dataTable)
    {
        if (!PermissionCommon::check('pemohon.list')) abort(403);
        return $dataTable->render('pages.administrasi.pemohon.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!PermissionCommon::check('pemohon.create')) abort(403);
        $body = view('pages.administrasi.pemohon.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Daftarkan Pemohon',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!PermissionCommon::check('pemohon.create')) abort(403);
        $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'alamat' => 'required',
        ], [
            'name.required' => 'Nama Lengkap tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'no_telp.required' => 'No Telpon tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
        ]);
        $data = $request->except('_token');
        try {
            $trx = Pemohon::create([
                'uid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'nik' => $data['nik'],
                'email' => $data['email'],
                'no_telp' => $data['no_telp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'agama' => $data['agama'],
                'status' => $data['status'],
                'alamat' => $data['alamat'],
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Mendaftarkan Pemohon'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Mendaftarkan Pemohon'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal'
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemohon $pemohon)
    {
        $body = view('pages.administrasi.pemohon.detail', compact('pemohon'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pemohon',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemohon $pemohon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemohon $pemohon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemohon $pemohon)
    {
        if (!PermissionCommon::check('pemohon.delete')) abort(403);
        try {
            $delete = $pemohon->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'Berhasil Menghapus Data'
                ]);
            } else {
                return response()->json([
                    'message' => 'Gagal Menghapus Data'
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        }
    }
}
