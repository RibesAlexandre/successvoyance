<?php
namespace App\Presenters;

/**
 * Class TellingEmailPresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait TellingEmailPresenter
{
    /**
     * Retourne le prix formaté
     *
     * @return string
     */
    public function getAmountPriceAttribute()
    {
        return number_format(($this->amount / 100), 0, ',', ' ');
    }
}