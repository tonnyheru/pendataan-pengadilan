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

    public static function getGolonganDarahLabel($id)
    {
        $golonganDarah = self::getGolonganDarah();
        return $golonganDarah[$id] ?? 'Tidak Tahu';
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

    public static function getAgamaLabel($id)
    {
        $agama = self::getAgama();
        return $agama[$id] ?? 'Tidak Tahu';
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

    public static function getStatusPernikahanLabel($id)
    {
        $statusPernikahan = self::getStatusPernikahan();
        return $statusPernikahan[$id] ?? 'Tidak Tahu';
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

    public static function getStatusHubunganKeluargaLabel($id)
    {
        $statusHubunganKeluarga = self::getStatusHubunganKeluarga();
        return $statusHubunganKeluarga[$id] ?? 'Tidak Tahu';
    }

    public static function getPendidikan()
    {
        return [
            1 => 'Tidak/Belum Sekolah',
            2 => 'Belum Tamat SD/Sederajat',
            3 => 'Tamat SD/Sederajat',
            4 => 'SLTP/Sederajat',
            5 => 'SLTA/Sederajat',
            6 => 'Diploma I/II',
            7 => 'Akademi/Diploma III/Sarjana Muda',
            8 => 'Diploma IV/Strata I',
            9 => 'Strata II',
            10 => 'Strata III',
        ];
    }

    public static function getPendidikanLabel($id)
    {
        $pendidikan = self::getPendidikan();
        return $pendidikan[$id] ?? 'Tidak Tahu';
    }

    public static function getPekerjaan()
    {
        return [
            1 => "BELUM/TIDAK BEKERJA",
            2 => "MENGURUS RUMAH TANGGA",
            3 => "PELAJAR/MAHASISWA",
            4 => "PENSIUNAN",
            5 => "PEGAWAI NEGERI SIPIL (PNS)",
            6 => "TENTARA NASIONAL INDONESIA",
            7 => "KEPOLISIAN REPUBLIK INDONESIA (POLRI)",
            8 => "PERDAGANGAN",
            9 => "PETANI/PEKEBUN",
            10 => "PETERNAK",
            11 => "NELAYAN/PERIKANAN",
            12 => "INDUSTRI",
            13 => "KONSTRUKSI",
            14 => "TRANSPORTASI",
            15 => "KARYAWAN SWASTA",
            16 => "KARYAWAN BUMN",
            17 => "KARYAWAN BUMD",
            18 => "KARYAWAN HONORER",
            19 => "BURUH HARIAN LEPAS",
            20 => "BURUH TANI/PERKEBUNAN",
            21 => "BURUH NELAYAN/PERIKANAN",
            22 => "BURUH PETERNAKAN",
            23 => "PEMBANTU RUMAH TANGGA",
            24 => "TUKANG CUKUR",
            25 => "TUKANG LISTRIK",
            26 => "TUKANG BATU",
            27 => "TUKANG KAYU",
            28 => "TUKANG SOL SEPATU",
            29 => "TUKANG LAS/PANDAI BESI",
            30 => "TUKANG JAHIT",
            31 => "TUKANG GIGI",
            32 => "PENATA RIAS",
            33 => "PENATA BUSANA",
            34 => "PENATA RAMBUT",
            35 => "MEKANIK",
            36 => "SENIMAN",
            37 => "TABIB",
            38 => "PARAJI",
            39 => "PERANCANG BUSANA",
            40 => "PENERJEMAH",
            41 => "IMAM MASJID",
            42 => "PENDETA",
            43 => "PASTOR",
            44 => "WARTAWAN",
            45 => "USTADZ/MUBALIGH",
            46 => "JURU MASAK",
            47 => "PROMOTOR ACARA",
            48 => "ANGGOTA DPR RI",
            49 => "ANGGOTA DPD RI",
            50 => "ANGGOTA BPK",
            51 => "PRESIDEN",
            52 => "WAKIL PRESIDEN",
            53 => "ANGGOTA MAHKAMAH KONSTITUSI",
            54 => "ANGGOTA KABINET KEMENTRIAN",
            55 => "DUTA BESAR",
            56 => "GUBERNUR",
            57 => "WAKIL GUBERNUR",
            58 => "BUPATI",
            59 => "WAKIL BUPATI",
            60 => "WALIKOTA",
            61 => "WAKIL WALIKOTA",
            62 => "ANGGOTA DPRD PROVINSI",
            63 => "ANGGOTA DPRD KOTA",
            64 => "DOSEN",
            65 => "GURU",
            66 => "PILOT",
            67 => "PENGACARA",
            68 => "NOTARIS",
            69 => "ARSITEK",
            70 => "AKUNTAN",
            71 => "KONSULTAN",
            72 => "DOKTER",
            73 => "BIDAN",
            74 => "PERAWAT",
            75 => "APOTEKER",
            76 => "PSIKIATER/PSIKOLOG",
            77 => "PENYIAR TELEVISI",
            78 => "PENYIAR RADIO",
            79 => "PELAUT",
            80 => "PENELITI",
            81 => "SOPIR",
            82 => "PIALANG",
            83 => "PARANORMAL",
            84 => "PEDAGANG",
            85 => "PERANGKAT DESA",
            86 => "KEPALA DESA",
            87 => "BIARAWAN/BIARAWATI",
            88 => "WIRASWASTA",
            89 => "PEKERJAAN LAINNYA",
        ];
    }

    public static function getPekerjaanLabel($id)
    {
        $pekerjaan = self::getPekerjaan();
        return $pekerjaan[$id] ?? 'Tidak Tahu';
    }

    public static function getProvinceLabel($province)
    {
        $provinces = json_decode(file_get_contents(public_path('data/provinces.json')));
        foreach ($provinces as $prov) {
            if ($prov->id == $province) {
                return $prov->name;
            }
        }
        return '-';
    }

    public static function getRegencyLabel($regency)
    {
        $regencies = json_decode(file_get_contents(public_path('data/regencies.json')));
        foreach ($regencies as $reg) {
            if ($reg->id == $regency) {
                return $reg->name;
            }
        }
        return '-';
    }

    public static function getDistrictLabel($district)
    {
        $districts = json_decode(file_get_contents(public_path('data/districts.json')));
        foreach ($districts as $dist) {
            if ($dist->id == $district) {
                return $dist->name;
            }
        }
        return '-';
    }
    public static function getVillageLabel($village)
    {
        $villages = json_decode(file_get_contents(public_path('data/villages.json')));
        foreach ($villages as $vil) {
            if ($vil->id == $village) {
                return $vil->name;
            }
        }
        return '-';
    }
}
