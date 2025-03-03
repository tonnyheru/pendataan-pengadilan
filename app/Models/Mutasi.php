<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "mutasi";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uid',
        'name',
        'origin_name',
        'created_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
