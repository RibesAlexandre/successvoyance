<?php
namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @author Alexandre Ribes
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once app_path() . '/helpers.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('Sync', function() {
            return new App\Services\Sync();
        });

        App::bind('Audiotel', function() {
            return new App\Services\Audiotel();
        });

        App::bind('Utils', function() {
            return new App\Services\Utils();
        });
    }
}
