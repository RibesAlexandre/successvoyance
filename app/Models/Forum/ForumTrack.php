<?php
namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ForumTrack
 * @author Alexandre Ribes
 * @package App\Models\Forum
 */
class ForumTrack extends Model
{
    protected $table = 'forum_forums_tracks';

    protected $fillable = ['user_id', 'forum_id', 'read_at'];

    public $timestamps = false;

    protected $dates = ['read_at'];

    /**
     * utilisateur associé
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
}
