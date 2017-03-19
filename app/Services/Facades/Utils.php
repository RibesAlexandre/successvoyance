<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Utils
 * @author Alexandre Ribes
 * @package App\Services\Facades
 */
class Utils extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Utils';
    }
}