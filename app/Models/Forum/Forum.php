<?php
namespace App\Models\Forum;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Forum
 * @author Alexandre Ribes
 * @package App\Models\Forum
 */
class Forum extends Model
{
    protected $table = 'forum_forums';

    protected $fillable = ['name', 'slug', 'content', 'category_id', 'message_at', 'position'];

    public $timestamps = false;

    protected $dates = ['message_at'];

    /**
     * Catégorie du forum
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Sujets du forum
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class, 'forum_id');
    }

    /**
     * Rôles associés au forum
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_forums', 'forum_id');
    }

    /**
     * Tracks du forum
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks()
    {
        return $this->hasMany(ForumTrack::class, 'forum_id');
    }
}
