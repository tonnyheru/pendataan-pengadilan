<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "pemohon";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'name',
        'nik',
        'alamat',
        'email',
        'no_telp',
        'jenis_kelamin',
        'agama',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];
}
