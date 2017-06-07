<?php
namespace App\Providers;

use App\Http\Controllers\Composers\LinksComposer;
use View;
use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\Composers\SignsComposer;
use App\Http\Controllers\Composers\ConfigComposer;

/**
 * Class ComposerServiceProdivider
 * @author Alexandre Ribes
 * @package App\Providers
 */
class ComposerServiceProdivider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', ConfigComposer::class);
        View::composer('*', SignsComposer::class);
        View::composer('*', LinksComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
