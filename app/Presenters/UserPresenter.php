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
        if( $this->can_full_name == 0 ) {
            return $this->nickname;
        } elseif ( $this->can_full_name == 1 ) {
            return $this->firstname;
        } else {
            return $this->firstname . ' ' . $this->name;
        }
    }

    /**
     * Retourne le prénom de l'utilisateur
     *
     * @return mixed
     */
    public function getFirstnameAttribute($value)
    {
        if( is_null($value) || empty($value) ) {
            return $this->nickname;
        }

        return $value;
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

    /**
     * Retourne la date de naissance formatée
     *
     * @param $value
     * @return string
     */
    public function getBirthdayAttribute($value)
    {
        return is_null($value) ? 'Non renseigné' : Date::parse($value)->format('d M Y');
    }

    public function getDobDateAttribute()
    {
        return is_null($this->dob) ? null : Date::parse($this->dob)->format('Y-m-d');
    }

    /**
     * Retourne l'âge de l'utilisateur
     *
     * @return null
     */
    public function getAgeAttribute()
    {
        return !is_null($this->dob) ? Date::createFromDate(Date::parse($this->dob)->format('Y'), Date::parse($this->dob)->format('m'), Date::parse($this->dob)->format('d'))->age : null;
    }

    /**
     * Nombre de commentaires de l'utilisateur
     *
     * @return int
     */
    public function getCommentsCountAttribute()
    {
        if( !array_key_exists('countComments', $this->relations) ) {
            $this->load('countComments');
        }

        $related = $this->getRelation('countComments');
        return ($related) ? (int) $related->aggregate : 0;
    }

    /**
     * Nombre de sujets de l'utilisateur
     *
     * @return int
     */
    public function getTopicsCountAttribute()
    {
        if( !array_key_exists('countTopics', $this->relations) ) {
            $this->load('countTopics');
        }

        $related = $this->getRelation('countTopics');
        return ($related) ? (int) $related->aggregate : 0;
    }

    /**
     * Nombre de messages de l'utilisateur
     *
     * @return int
     */
    public function getMessagesCountAttribute()
    {
        if( !array_key_exists('countMessages', $this->relations) ) {
            $this->load('countMessages');
        }

        $related = $this->getRelation('countMessages');
        return ($related) ? (int) $related->aggregate : 0;
    }

    /**
     * Determine whether the user can do specific permission that given by name parameter.
     *
     * @param $name
     *
     * @return bool
     */
    public function isAuthorized($name)
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name == $name || $permission->slug == $name || $permission->id == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Détermine si l'utilisateur fait parti d'un ou de plusieurs rôles spécifiques
     *
     * @param $name
     * @return bool
     */
    public function isRole($name) {
        if( is_array($name) ) {
            $rolesIds = [];
            $rolesSlugs = [];
            foreach( $this->roles as $role ) {
                $rolesIds[] = $role->id;
                $rolesSlugs[] = $role->slug;
            }

            if( in_array(str_slug($name), $rolesSlugs) || in_array(intval($name), $rolesIds) ) {
                return true;
            }
        } else {
            foreach( $this->roles as $role ) {
                if( str_slug($name) == $role->slug || intval($name) == $role->id ) {
                    return true;
                }
            }
        }

        return false;
    }
}