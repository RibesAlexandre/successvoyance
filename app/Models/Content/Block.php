<?php
namespace App\Models\Content;

use Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Block
 * @author Alexandre Ribes
 * @package App
 */
class Block extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'link', 'template', 'background', 'content', 'day_begin', 'hour_begin', 'day_ending', 'hour_ending', 'begin_at', 'ending_at', 'container', 'enabled', 'deleted_at'];

    protected $dates = ['begin_at', 'ending_at', 'deleted_at'];

    /**
     * Block actif
     *
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where(function($query) {
            $query->where(function($query) {
                $query->where('begin_at', '<=', Date::now())->where('ending_at', '>=', Date::now());
            })->orWhere(function($query) {
                $query->where(function($query) {
                    $query->where('day_begin', Date::now()->format('l'))->where('hour_begin', '<', Date::now()->format('H:i'));
                })->orWhere(function($query) {
                    $query->where('day_ending', '>', Date::now()->format('l'))->where('hour_ending', '>', Date::now()->format('H:i'));
                });
            });
        })->where('enabled', true);
    }
}
