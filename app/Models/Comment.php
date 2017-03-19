<?php
namespace App\Models;

use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @author Alexandre Ribes
 * @package App\Models
 */
class Comment extends Model
{
    use DatePresenter, SoftDeletes;

    protected $fillable = ['content', 'user_id', 'soothsayer_id', 'horoscope_id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Auteur du commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Voyant associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soothsayer()
    {
        return $this->belongsTo(Soothsayer::class, 'soothsayer_id');
    }

    /**
     * Horoscope associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function horoscope()
    {
        return $this->belongsTo(Horoscope::class, 'horoscope_id');
    }
}
