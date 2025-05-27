<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktaPerceraianDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "akta_perceraian_details";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'nik_suami',
        'kk_suami',
        'paspor_suami',
        'nama_suami',
        'tempat_lahir_suami',
        'tanggal_lahir_suami',
        'alamat_suami',
        'perceraian_ke',
        'kewarganegaraan_suami',
        'nik_istri',
        'kk_istri',
        'paspor_istri',
        'nama_istri',
        'tempat_lahir_istri',
        'tanggal_lahir_istri',
        'alamat_istri',
        'kewarganegaraan_istri',
        'yang_mengajukan',
        'no_akta_kawin',
        'tanggal_akta_kawin',
        'tempat_perkawinan',
        'no_putusan',
        'tanggal_putusan',
        'sebab_perceraian',
        'tanggal_lapor',
        'waktu_lapor',
        'keterangan',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }
}
