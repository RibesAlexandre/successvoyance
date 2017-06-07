<?php
namespace App\Presenters;

use Date;

/**
 * Class AstrologicalSignPresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait AstrologicalSignPresenter
{
    /**
     * Retourne les images des signes astrologiques
     *
     * @param $value
     * @return string
     */
    public function getLogoAttribute($value)
    {
        return asset('uploads/signs/' . $value);
    }

    /**
     * Date de début du signe
     *
     * @return mixed
     */
    public function getSignBeginDateAttribute()
    {
        return Date::parse($this->begin_at)->format('d F');
    }

    /**
     * Date de fin du signe
     *
     * @return mixed
     */
    public function getSignEndingDateAttribute()
    {
        return Date::parse($this->ending_at)->format('d F');
    }

    /**
     * Date pour la comparaison avec le signe
     *
     * @return mixed
     */
    public function getSignBeginMonthAttribute()
    {
        return Date::parse($this->begin_at)->format('m-d');
    }

    /**
     * Date pour la comparaison avec le signe
     *
     * @return mixed
     */
    public function getSignEndingMonthAttribute()
    {
        return Date::parse($this->ending_at)->format('m-d');
    }
}