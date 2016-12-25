<?php
namespace App\Presenters;

use Date;

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

    /**
     * Retourne l'avatar d'un utilisateur
     *
     * @return string
     */
    public function avatar()
    {
        return is_null($this->avatar) ? asset('imgs/components/default-avatar.png') : asset('uploads/avatars/' . $this->avatar);
    }

    public function getDobAttribute($value)
    {
        return is_null($value) ? 'Non renseigné' : Date::parse($value)->format('d M Y');
    }
}