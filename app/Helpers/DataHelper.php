<?php

namespace App\Helpers;

class DataHelper
{
    public static function getGolonganDarah()
    {
        return [
            1 => 'A',
            2 => 'B',
            3 => 'AB',
            4 => 'O',
            5 => 'A+',
            6 => 'A-',
            7 => 'B+',
            8 => 'B-',
            9 => 'AB+',
            10 => 'AB-',
            11 => 'O+',
            12 => 'O-',
            13 => 'Tidak Tahu',
        ];
    }

    public static function getAgama()
    {
        return [
            1 => 'Islam',
            2 => 'Kristen',
            3 => 'Katholik',
            4 => 'Hindu',
            5 => 'Buddha',
            6 => 'Konghuchu',
            7 => 'Kepercayaan Terhadap Tuhan Yang Maha Esa',
        ];
    }

    public static function getStatusPernikahan()
    {
        return [
            1 => 'Belum Kawin',
            2 => 'Kawin',
            3 => 'Cerai Hidup',
            4 => 'Cerai Mati',
        ];
    }

    public static function getStatusHubunganKeluarga()
    {
        return [
            1 => 'Kepala Keluarga',
            2 => 'Suami',
            3 => 'Istri',
            4 => 'Anak',
            5 => 'Menantu',
            6 => 'Cucu',
            7 => 'Orang Tua',
            8 => 'Mertua',
            9 => 'Famili Lain',
            10 => 'Pembantu',
            11 => 'Lainnya',
        ];
    }
}
