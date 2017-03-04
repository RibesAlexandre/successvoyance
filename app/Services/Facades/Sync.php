<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sync
 * @author Alexandre Ribes
 * @package App\Services\Facades
 */
class Sync extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Sync';
    }
}