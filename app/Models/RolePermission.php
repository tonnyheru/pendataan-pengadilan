<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "role_permissions";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'role_uid',
        'permission_uid',
    ];

    protected $casts = [
        'role_uid' => 'string',
        'permission_uid' => 'string',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_uid', 'uid');
    }
    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'permission_uid', 'uid');
    }
}
