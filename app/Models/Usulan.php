<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "usulan";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'no_perkara',
        'jenis_perkara',
        'path_ktp',
        'path_kk',
        'path_akta',
        'path_pendukung',
        'path_penetapan',
        'path_nikah',
        'path_pengantar',
        'delegasi',
        'pemohon_uid',
        'disdukcapil_uid',
        'catatan',
        'is_approve',
        'approved_at',
        'approved_by',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class, 'pemohon_uid', 'uid');
    }

    public function disdukcapil()
    {
        return $this->belongsTo(Disdukcapil::class, 'disdukcapil_uid', 'uid');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'uid');
    }
}
