<?php
namespace App\Presenters;

use Auth;
use Date;

/**
 * Class CommentPresenter
 * @author Alexandre Ribes
 * @package App\Presenters
 */
trait CommentPresenter
{
    /**
     * Détermines si le commentaire est modifiable/supprimable par l'utilisateur
     *
     * @return bool
     */
    public function isEditable()
    {
        if( Auth::check() && (( Auth::user()->id == $this->user_id && $this->created_at > Date::now()->subMinutes(15)) /*|| Auth::user()->isStaff()*/) ) {
            return true;
        }
        return false;
    }

    /**
     * Retourne l'url du commentaire
     *
     * @return string
     */
    public function url()
    {
        if( !is_null($this->soothsayer_id) ) {
            return route('soothsayers.show', ['slug' => $this->soothsayer->slug]) . '#comment_' . $this->id;
        } else if( !is_null($this->horoscope_id) ) {
            return route('signs.horoscopes', ['slug' => $this->horoscope->slug]) . '#comment_' . $this->id;
        } else {
            return '#';
        }
    }
}