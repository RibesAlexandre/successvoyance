<?php

namespace App\Models;

//  Models
use App\Models\Content\Picture;
use Illuminate\Database\Eloquent\Model;

//  Traits
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Horoscope
 * @author Alexandre Ribes
 * @package App\Models
 */
class Horoscope extends Model
{
    use SoftDeletes, DatePresenter;

    protected $table = 'horoscopes';

    protected $fillable = ['name', 'slug', 'content', 'sign_id', 'begin_at', 'ending_at', 'deleted_at'];

    protected $dates = ['deleted_at'];

    /**
     * Signe astrologique associé
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sign()
    {
        return $this->belongsTo(AstrologicalSign::class, 'sign_id');
    }

    /**
     * Images associés à l'horoscope
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pictures()
    {
        return $this->belongsToMany(Picture::class, 'horoscopes_pictures', 'horoscope_id');
    }

    /**
     * ------------------
     *  GETTERS
     * ------------------
     */

    /**
     * ------------------
     *  SETTERS
     * ------------------
     */

    /**
     * Définition du slug à la volée
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}
