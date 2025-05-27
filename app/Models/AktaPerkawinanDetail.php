<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktaPerkawinanDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "akta_perkawinan_details";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'nik_suami',
        'kk_suami',
        'nama_suami',
        'kewarganegaraan_suami',
        'alamat_suami',
        'anak_ke_suami',
        'perkawinan_ke_suami',
        'nama_istri_terakhir',
        'istri_ke',
        'nik_ayah_suami',
        'nama_ayah_suami',
        'nik_ibu_suami',
        'nama_ibu_suami',
        'nik_istri',
        'kk_istri',
        'nama_istri',
        'kewarganegaraan_istri',
        'alamat_istri',
        'anak_ke_istri',
        'perkawinan_ke_istri',
        'nama_suami_terakhir',
        'nik_ayah_istri',
        'nama_ayah_istri',
        'nik_ibu_istri',
        'nama_ibu_istri',
        'nik_saksi1',
        'nama_saksi1',
        'nik_saksi2',
        'nama_saksi2',
        'tanggal_pemberkatan',
        'tempat_pemberkatan',
        'tanggal_lapor',
        'waktu_lapor',
        'agama',
        'nama_pemuka_agama',
        'no_putusan',
        'tanggal_putusan'
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }
}
