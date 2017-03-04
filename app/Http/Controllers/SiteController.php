<?php

namespace App\Http\Controllers;

use Audiotel;
use Illuminate\Http\Request;

/**
 * Class SiteController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    protected $consultants = [];

    public function index()
    {
        if( count($this->consultants) < 1 ) {
            $consultants = [];
            $consultantsJson = json_decode(Audiotel::getConsultantsJson('audiotel_08'));
            foreach( $consultantsJson->list_consultants as $c) {
                $consultants[] = [
                    'nickname'  =>  $c->pseudo,
                    'email'     =>  $c->email,
                    'phone'     =>  $c->phone,
                    'content'   =>  nl2br(stripslashes(trim($c->desc_audiotel))),
                    //'status_cb' =>  $c->status_cb == 'DISPONIBLE' ? true : false,
                    'status_08' =>  $c->status_08 == 'DISPONIBLE' ? true : false,
                    'picture'   =>  $c->photo,
                ];
            }
            $this->consultants = $consultants;
        }

        return view('pages.home')->with('consultants', $this->consultants);
    }

    public function page($slug)
    {

    }
}
