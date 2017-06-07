<?php
namespace App\Http\Controllers\Composers;

use Date;
use Cache;

use Illuminate\View\View;
use App\Models\Content\Block;

/**
 * Class BlocksComposer
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Composers
 */
class BlocksComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /*
        $blocks = Cache::remember('blocks_site', 60 * 24, function() {
            return Block::where(function($query) {
                $query->where('day_begin', Date::now()->parse('F'))->
            })
        })
        */
    }
}