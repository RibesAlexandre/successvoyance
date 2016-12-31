<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission
 * @author Alexandre Ribes
 * @package App
 */
class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'content', 'section', 'deleted_at'];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

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
