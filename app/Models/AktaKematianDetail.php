<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktaKematianDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "akta_kematian_details";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'nik_jenazah',
        'nama_jenazah',
        'wilayah_kelahiran',
        'provinsi_kelahiran',
        'tanggal_kematian',
        'waktu_kematian',
        'tempat_kematian',
        'sebab_kematian',
        'yang_menerangkan',
        'keterangan',
        'nik_ayah',
        'nama_ayah',
        'nik_ibu',
        'nama_ibu',
        'nik_saksi1',
        'nama_saksi1',
        'nik_saksi2',
        'nama_saksi2'
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }
}
