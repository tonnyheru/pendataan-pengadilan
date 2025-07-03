<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDocument extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "submission_documents";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'submission_uid',
        'document_name',
        'document_type',
        'file_path',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    protected $appends = ['full_path'];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_uid', 'uid');
    }

    public function getFullPathAttribute()
    {
        return asset("upload/file_" . $this->document_type . "/" . $this->file_path);
    }
}
