<?php

namespace App\Models;

use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rating
 * @author Alexandre Ribes
 * @package App\Models
 */
class Rating extends Model
{
    use SoftDeletes, DatePresenter;

    protected $fillable = ['user_id', 'soothsayer_id', 'stars', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
     * Voyant associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soothsayer()
    {
        return $this->belongsTo(Soothsayer::class, 'soothsayer_id');
    }
}

