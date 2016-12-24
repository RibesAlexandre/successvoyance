<?php
namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @author Alexandre Ribes
 * @package App\Models\Forum
 */
class Post extends Model
{
    protected $table = ['forum_posts'];

    protected $fillable = ['content', 'user_id', 'topic_id', 'created_at', 'updated_at', 'deleted_at', 'enabled'];

    protected $dates = ['deleted_at'];

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
     * Sujet associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * Messages valides
     *
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
