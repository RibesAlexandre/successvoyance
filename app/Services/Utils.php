<?php
namespace App\Services;

use Image;

/**
 * Class Utils
 * @author Alexandre Ribes
 * @package App\Services
 */
class Utils
{
    /**
     * Retourne un pourcentage
     *
     * @param $data
     * @param $total
     * @param int $round
     * @return float|int
     */
    public function percent($data, $total, $round = 0)
    {
        return ($total < 1 || $data < 1) ? 0 : round(($data / $total * 100), $round);
    }

    /**
     * Permet d'uploader un fichier simplement
     *
     * @param $picture
     * @param $name
     * @param $path
     * @param bool $public
     */
    public function uploadPicture($picture, $name, $path, $public = true)
    {
        $picture = Image::make($picture);
        $picture->save(($public ? public_path($path) : $path) . '/' . $name, 95);
    }

    /**
     * Permet de supprimer un fichier simplement
     *
     * @param $filePath
     * @param bool $public
     */
    public function removeFile($filePath, $public = true)
    {
        if( is_array($filePath) ) {
            foreach( $filePath as $file ) {
                if( is_file(($public ? public_path($file) : $file)) ) {
                    unlink(($public ? public_path($file) : $file));
                }
            }
        } else {
            if( is_file(($public ? public_path($filePath) : $filePath)) ) {
                unlink(($public ? public_path($filePath) : $filePath));
            }
        }
    }
}