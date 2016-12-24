<?php
namespace App\Presenters;

/**
 * Class UserPresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait UserPresenter
{
    /**
     * Retourne le nom complet d'un utilisateur
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->name;
    }
}