<?php
namespace App\Presenters;

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
}