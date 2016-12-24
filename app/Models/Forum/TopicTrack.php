<?php

namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TopicTrack
 * @author Alexandre Ribes
 * @package App\Models\Forum
 */
class TopicTrack extends Model
{
    protected $table = 'forum_topics_tracks';

    protected $fillable = ['user_id', 'topic_id', 'forum_id', 'read_at'];

    public $timestamps = false;

    protected $dates = ['read_at'];

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
     * Topic associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
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
}
