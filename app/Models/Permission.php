<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @author Alexandre Ribes
 * @package App
 */
class Permission extends Model
{
    protected $fillable = ['name', 'slug', 'content', 'section'];

    public $timestamps = false;

    /**
     * Rôles associés à la permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions', 'permission_id');
    }
}
