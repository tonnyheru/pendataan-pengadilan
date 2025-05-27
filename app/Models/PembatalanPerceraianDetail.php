<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembatalanPerceraianDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "pembatalan_perceraian_details";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'nama_suami',
        'nama_istri',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }
}
