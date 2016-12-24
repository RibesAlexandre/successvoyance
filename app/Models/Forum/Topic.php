<?php
namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * @author Alexandre Ribes
 * @package App\Models\Forum
 */
class Topic extends Model
{
    protected $table = 'forum_topics';

    protected $fillable = ['title', 'slug', 'content', 'user_id', 'forum_id', 'message_at', 'deleted_at', 'enabled'];

    protected $dates = ['created_at', 'updated_at', 'message_at', 'deleted_at'];

    /**
     * Utilisateur associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Forum associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    /**
     * Tracks du sujet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks()
    {
        return $this->hasMany(TopicTrack::class, 'topic_id');
    }

    /**
     * Topics actifs
     *
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
