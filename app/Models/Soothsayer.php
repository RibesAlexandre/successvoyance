<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\SoothsayerPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use AstritZeqiri\LaravelSearchable\Traits\Searchable;

/**
 * Class Soothsayer
 * @author Alexandre Ribes
 * @package App\Models
 */
class Soothsayer extends Model
{
    use SoftDeletes, SoothsayerPresenter, Searchable;

    protected $fillable = ['slug', 'nickname', 'code', 'phone', 'content', 'picture', 'stars', 'ratings', 'total_consultations', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $timestamps = false;

    protected static $searchOn = ['nickname', 'content'];

    /**
     * User associé au voyant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->hasOne(User::class, 'soothsayer_id');
    }

    /**
     * Commentaires associés
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'soothsayer_id');
    }

    /**
     * Votes associés
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'soothsayer_id');
    }

    /**
     * Nombre de favori de chaque voyant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'soothsayers_favorites', 'soothsayer_id');
    }

    /**
     * Nombre de favoris du voyant
     *
     * @return mixed
     */
    public function favoritesCount()
    {
        return $this->hasOne(SoothsayerFavorite::class)
            ->selectRaw('soothsayer_id, count(*) as aggregate')
            ->groupBy('soothsayer_id');
    }

    /**
     * Commentaires associés au voyant
     *
     * @return mixed
     */
    public function commentsCount()
    {
        return $this->hasOne(Comment::class)
            ->selectRaw('soothsayer_id, count(*) as aggregate')
            ->whereNull('parent_id')
            ->groupBy('soothsayer_id');
    }
}
