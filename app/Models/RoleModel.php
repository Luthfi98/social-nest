<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RoleModel extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'date:Y-m-d H:i:s',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
