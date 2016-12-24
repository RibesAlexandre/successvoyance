<?php
namespace App\Presenters;

use Date;

/**
 * Class DatePresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait DatePresenter
{
    public function getCreatedAgoAttribute()
    {
        return Date::parse($this->created_at)->diffForHumans();
    }

    public function getUpdatedAgoAttribute()
    {
        return Date::parse($this->updated_at)->diffForHumans();
    }

    public function getLastConnexionAgoAttribute()
    {
        return Date::parse($this->last_connexion)->diffForHumans();
    }
}