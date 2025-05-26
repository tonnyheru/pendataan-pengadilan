<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "submissions";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'no_perkara',
        'submission_type',
        'pemohon_uid',
        'disdukcapil_uid',
        'status',
        'catatan',
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

    public function documents()
    {
        return $this->hasMany(SubmissionDocument::class, 'submission_uid', 'uid');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'uid');
    }

    public function perbaikanAktaDetail()
    {
        return $this->hasOne(PerbaikanAktaDetail::class, 'submission_uid', 'uid');
    }

    public function aktaKematianDetail()
    {
        return $this->hasOne(AktaKematianDetail::class, 'submission_uid', 'uid');
    }
}
