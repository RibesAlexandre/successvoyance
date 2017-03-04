<?php
namespace App\Http\Controllers\Composers;

use Cache;
use App\Models\Config;
use Illuminate\View\View;

/**
 * Class ConfigComposer
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Composers
 */
class ConfigComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $config = Cache::rememberForEver('cfg', function() {
            $cfg = [];
            foreach( Config::all() as $c ) {
                $cfg[$c->key] = $c->value;
            }
            return $cfg;
        });

        $view->with('cfg', $config);
    }
}