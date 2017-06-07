<?php
namespace App\Http\Controllers\Composers;

use Cache;
use Illuminate\View\View;
use App\Models\Content\Link;

/**
 * Class LinksComposer
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Composers
 */
class LinksComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $headerLinks = Cache::rememberForEver('links_header', function() {
            return Link::with('childrens')->where('container', 'header')->whereNull('parent_id')->orderBy('position', 'ASC')->get();
        });

        $footerLinks = Cache::rememberForever('links_footer', function() {
            return Link::where('container', 'footer')->orderBy('position', 'ASC')->whereNull('parent_id')->get();
        });

        $view->with([
            'headerLinks'   =>  $headerLinks,
            'footerLinks'   =>  $footerLinks,
        ]);
    }
}