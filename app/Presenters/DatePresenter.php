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
    /**
     * Retourne le temps passé depuis la date de création
     *
     * @return mixed
     */
    public function getCreatedAgoAttribute()
    {
        return Date::parse($this->created_at)->diffForHumans();
    }

    /**
     * Retourne le temps passé depuis la date de mise à jour
     *
     * @return mixed
     */
    public function getUpdatedAgoAttribute()
    {
        return Date::parse($this->updated_at)->diffForHumans();
    }

    /**
     * Retourne le temps passé depuis la date de dernière connexion
     *
     * @return mixed
     */
    public function getLastConnexionAgoAttribute()
    {
        return Date::parse($this->last_connexion)->diffForHumans();
    }

    /**
     * Retourne la date de création formatée
     *
     * @return string
     */
    public function getCreatedAttribute()
    {
        return ucwords(Date::parse($this->created_at)->format('d F Y \à H\hi'));
    }

    /**
     *  Retourne la date de mise à jour formatée
     *
     * @return string
     */
    public function getUpdatedAttribute()
    {
        return ucwords(Date::parse($this->updated_at)->format('d F Y \à H\hi'));
    }

    /**
     * Retourne la date de dernière connexion formatée
     *
     * @return string
     */
    public function getConnectedAttribute()
    {
        return ucwords(Date::parse($this->last_connexion)->format('d F Y \à H\hi'));
    }
}