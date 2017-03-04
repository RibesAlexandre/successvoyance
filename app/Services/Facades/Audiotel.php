<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Audiotel
 * @author Alexandre Ribes
 * @package App\Services\Facades
 */
class Audiotel extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Audiotel';
    }
}