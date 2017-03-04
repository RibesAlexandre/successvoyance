<?php
namespace App\Models\Content;

use Date;
use Illuminate\Database\Eloquent\Model;

//  Presenters
use App\Presenters\DatePresenter;
use App\Presenters\CarouselPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Carousel
 * @author Alexandre Ribes
 * @package App
 */
class Carousel extends Model
{
    use SoftDeletes, DatePresenter, CarouselPresenter;

    protected $fillable = ['title', 'link', 'content', 'picture', 'begin_at', 'ending_at', 'position', 'enabled', 'deleted_at'];

    protected $dates = ['begin_at', 'ending_at'];

    /**
     * Carousel actif
     *
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true)->where('begin_at', '<=', Date::now())->where('ending_at', '>=', Date::now());
    }

    public function setBeginAtAttribute($value)
    {
        $this->attributes['begin_at'] = strlen($value) < 1 ? null : $value;
    }

    public function setEndingAtAttribute($value)
    {
        $this->attributes['ending_at'] = strlen($value) < 1 ? null : $value;
    }
}
