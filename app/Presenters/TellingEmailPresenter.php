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
        $number = number_format(($this->amount / 100), 2, ',', ' ');
        return strpos($number,',') !== false ? rtrim(rtrim($number,'0'), ',') : $number;
    }
}