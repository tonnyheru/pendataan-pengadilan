<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengangkatanAnakDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "pengangkatan_anak_details";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'nama_anak',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }
}
