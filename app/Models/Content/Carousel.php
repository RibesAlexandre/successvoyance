<?php
namespace App\Models\Content;

use Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Carousel
 * @author Alexandre Ribes
 * @package App
 */
class Carousel extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'link', 'content', 'picture', 'begin_at', 'ending_at', 'enabled', 'deleted_at'];

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
}
