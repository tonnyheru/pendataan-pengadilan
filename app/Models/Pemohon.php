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
        'province',
        'regency',
        'district',
        'village',
        'kk',
        'nik',
        'tanggal_lahir',
        'tempat_lahir',
        'akta_kelahiran',
        'alamat',
        'email',
        'no_telp',
        'jenis_kelamin',
        'blood_type',
        'agama',
        'status_kawin',
        'akta_kawin',
        'tanggal_kawin',
        'akta_cerai',
        'tanggal_cerai',
        'family_relationship',
        'education',
        'job',
        'nama_ibu',
        'nama_ayah',
        'nomor_paspor',
        'nomor_paspor',
        'tanggal_berlaku_paspor',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function usulan()
    {
        return $this->hasMany(Usulan::class, 'pemohon_uid', 'uid');
    }
}
