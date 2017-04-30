<?php
namespace App\Presenters;

use Utils;
/**
 * Class SoothsayerPresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait SoothsayerPresenter
{
    /**
     * Retourne le bonm nombre d'étoiles
     *
     * @return string
     */
    public function getRatingAttribute()
    {
        $rating = str_limit(Utils::percent($this->stars, $this->ratings), 1, '');
        return $rating > 5 ? 5 : $rating;
    }

    /**
     * Nombre de commentaires du voyant
     *
     * @return int
     */
    public function getCommentsCountAttribute()
    {
        if( !array_key_exists('commentsCount', $this->relations) ) {
            $this->load('commentsCount');
        }

        $related = $this->getRelation('commentsCount');
        return ($related) ? (int) $related->aggregate : 0;
    }

    /**
     * Nombre de commentaires du voyant
     *
     * @return int
     */
    public function getFavoritesCountAttribute()
    {
        if( !array_key_exists('favoritesCount', $this->relations) ) {
            $this->load('favoritesCount');
        }

        $related = $this->getRelation('favoritesCount');
        return ($related) ? (int) $related->aggregate : 0;
    }
}