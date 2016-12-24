<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @author Alexandre Ribes
 * @package App\Models
 */
class Role extends Model
{
    protected $fillable = ['name', 'slug'];

    public $timestamps = false;

    /**
     * Permissions du rôle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id');
    }

    /**
     * Utilisateurs associés au rôle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users', 'role_id');
    }
}
