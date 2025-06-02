<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MenuModel extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'menus';

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'route',
        'icon',
        'order',
        'description',
        'status',
        'permissions',
        'is_public'
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'string',
        'permissions' => 'array',
        'created_at' => 'date:d M Y H:i',
    ];

    public function parent()
    {
        return $this->belongsTo(MenuModel::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuModel::class, 'parent_id');
    }

    public function isDescendantOf(MenuModel $menu)
    {
        $parent = $this->parent;

        while ($parent) {
            if ($parent->id === $menu->id) {
                return true;
            }
            $parent = $parent->parent;
        }

        return false;
    }

    
}
