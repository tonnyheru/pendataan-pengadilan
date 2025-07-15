<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanAktaDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "perbaikan_akta_details";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'jenis_akta',
        'nomor_akta',
        'jenis_elemen_perbaikan',
        'data_sebelum',
        'data_sesudah',
        'data_subject',
        'response_cimahi',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }
}
