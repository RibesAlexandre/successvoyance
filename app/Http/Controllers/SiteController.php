<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use DevDojo\Chatter\Models\Discussion;
use DevDojo\Chatter\Models\Post;
use Utils;
use Audiotel;
use App\Models\Soothsayer;
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
        $soothsayers = [];
        $soothsayersData = Soothsayer::all();
        foreach( $soothsayersData as $s ) {
            $soothsayers[$s->slug] = [
                'nickname'  =>  $s->nickname,
                'rating'    =>  str_limit(Utils::percent($s->stars, $s->ratings), 1, ''),
                'phone'     =>  $s->phone,
                'code'      =>  $s->code,
                'content'   =>  $s->content,
                'picture'   =>  $s->picture,
            ];
        }

        if( count($this->consultants) < 1 ) {
            $consultantsJson = json_decode(Audiotel::getConsultantsJson('audiotel_08'));
            foreach( $consultantsJson->list_consultants as $c) {

                if( !array_key_exists(str_slug($c->pseudo), $soothsayers) ) {
                    $create = [
                        'slug'      =>  str_slug($c->pseudo),
                        'nickname'  =>  $c->pseudo,
                        'content'   =>  strlen($c->desc_audiotel) > 0 ? $c->desc_audiotel : $c->desc_cb,
                        'phone'     =>  $c->phone,
                        'code'      =>  $c->code_direct,
                    ];

                    if( !is_null($c->photo) ) {
                        $picturePath = explode('/', $c->photo);
                        //Utils::uploadPicture($c->picture, end($picturePath), 'uploads/soothsayers');
                        file_put_contents(public_path('uploads/soothsayers/' . end($picturePath)), file_get_contents($c->photo));
                        $create = array_add($create, 'picture', end($picturePath));
                    }

                    Soothsayer::create($create);

                    $soothsayers[str_slug($c->pseudo)] = [
                        'nickname'  =>  $c->pseudo,
                        //'stars'     =>  0,
                        //'ratings'   =>  0,
                        'rating'    =>  0,
                    ];
                } else {
                    $pictureExplode = explode('/', $c->photo);
                    if( $c->phone != $soothsayers[str_slug($c->pseudo)]['phone'] || $c->code_direct != $soothsayers[str_slug($c->pseudo)]['code'] || ($c->desc_audiotel != $soothsayers[str_slug($c->pseudo)]['content'] && $c->desc_cb != $soothsayers[str_slug($c->pseudo)]['content']) || end($pictureExplode) != $soothsayers[str_slug($c->pseudo)]['picture']) {
                        $soothsayer = Soothsayer::where('slug', str_slug($c->pseudo))->firstOrFail();
                        Utils::removeFile('uploads/soothsayers/' . $soothsayer->picture);
                        //Utils::uploadPicture($c->photo, end($pictureExplode), 'uploads/soothsayers');
                        file_put_contents(public_path('uploads/soothsayers/' . end($pictureExplode)), file_get_contents($c->photo));
                        $soothsayer->update([
                            'phone'     =>  $c->phone,
                            'content'   =>  strlen($c->desc_audiotel) > 0 ? $c->desc_audiotel : $c->desc_cb,
                            'code'      =>  $c->code_direct,
                            'picture'   =>  end($pictureExplode),
                        ]);
                    }
                }

                $soothsayers[str_slug($c->pseudo)] = array_merge($soothsayers[str_slug($c->pseudo)], [
                    'email'         =>  $c->email,
                    'status_cb'     =>  $c->status_cb == 'DISPONIBLE' ? true : false,
                    'status_08'     =>  $c->status_08 == 'DISPONIBLE' ? true : false,
                    'tarif_cb'      =>  $c->tarif_cb,
                    'next_dispo_cb' =>  $c->next_dispo_cb,
                    'next_dispo_08' =>  $c->next_dispo_08,
                ]);
            }

            $consultantsCollection = collect($soothsayers);
            $consultants = $consultantsCollection->sortByDesc(function($consultant, $key) {
                return ($consultant['status_08'] ? 1000000 : 0) + $consultant['rating'];
            });

            $this->consultants = $consultants->all();
        }

        $comments = Comment::orderBy('created_at', 'DESC')->with('user')->with('soothsayer')->with('horoscope')->take(4)->get();
        //$messages = Post::orderBy('created_at')->with('user')->with('discussion')->where('locked', false)->take(5)->get();
        $topics = Discussion::orderBy('created_at', 'DESC')->with('user')->with('category')->take(4)->get();
        $topicsHot = Discussion::orderBy('answered', 'DESC')->with('user')->with('category')->take(4)->get();

        return view('pages.home', compact('comments', 'topics', 'topicsHot'))->with('consultants', $this->consultants);
    }

    public function page($slug)
    {

    }
}
