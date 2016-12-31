<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @author Alexandre Ribes
 * @package App\Models
 */
class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'deleted_at'];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

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

    /**
     * Formate le slug lors
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
        $this->attributes['slug'] = str_slug($value);
    }
}
