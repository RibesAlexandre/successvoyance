<?php
namespace App\Services;

use App\Models\Content\Picture;

/**
 * Class Sync
 * @author Alexandre Ribes
 * @package App\Services
 */
class Sync
{
    /**
     * Synchronise des images en formulaire en Many To Many pour un objet donné
     *
     * @param $object
     * @param $request
     * @return $this
     */
    public function syncPictures($object, $request)
    {
        if( $request->has('pictures') ) {
            $pictures = [];
            foreach( $request->input('pictures') as $p ) {
                $picture = Picture::where('id', $p)->first();
                if( $picture ) {
                    $pictures[] = $picture->id;
                }
            }

            $object->pictures()->sync($pictures);
        }

        return $this;
    }
}