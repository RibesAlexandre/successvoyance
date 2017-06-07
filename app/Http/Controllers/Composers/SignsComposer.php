<?php
namespace App\Http\Controllers\Composers;

use Cache;
use Illuminate\View\View;
use App\Models\AstrologicalSign;

/**
 * Class SignsComposer
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Composers
 */
class SignsComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $signs = Cache::remember('astrologicalSignsList', 60 * 24, function() {
            return AstrologicalSign::orderBy('begin_at', 'ASC')->get();
        });

        $view->with('astrologicalSignsList', $signs);
    }
}