<?php
namespace App\Models;

//  Models
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Forum\ForumTrack;

//  Illuminate
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @author Alexandre Ribes
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'firstname', 'email', 'password', 'avatar', 'dob', 'last_connexion', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['last_connexion', 'deleted_at'];

    /**
     * Sujets crées par l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class, 'user_id');
    }

    /**
     * Messages crées par l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    /**
     * Suivi des sujets lus par l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topicsTracks()
    {
        return $this->hasMany(TopicTrack::class, 'user_id');
    }

    /**
     * Suivi des forums lus par l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forumsTracks()
    {
        return $this->hasMany(ForumTrack::class, 'user_id');
    }

    /**
     * Roles de l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id');
    }

    /**
     * Enregistrement dans la newsletter pour l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function newsletter()
    {
        return $this->hasOne(Newsletter::class, 'user_id');
    }
}
