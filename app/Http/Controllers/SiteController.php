<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\NewsletterRequest;
use App\Http\Requests\RecruitmentRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UnsuscribeNewsletterRequest;
use App\Mail\ContactEmail;
use App\Models\AstrologicalSign;
use App\Models\Comment;
use App\Models\Content\Page;
use App\Models\Newsletter;
use App\Models\Recruitment;
use DevDojo\Chatter\Models\Discussion;
use DevDojo\Chatter\Models\Post;
use Utils;
use Audiotel;
use App\Models\Soothsayer;
use Illuminate\Http\Request;

use Auth;
use Mail;
use Date;
use Cache;

/**
 * Class SiteController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    protected $consultants = [];

    /**
     * Accueil du site
     *
     * @return $this
     */
    public function index()
    {
        $soothsayers = [];
        $soothsayersData = Cache::remember('soothsayers_index', 10, function() {
            return Soothsayer::with('commentsCount', 'favoritesCount')->get();
        });

        foreach( $soothsayersData as $s ) {
            $soothsayers[$s->slug] = [
                'id'            =>  $s->id,
                'nickname'      =>  $s->nickname,
                'slug'          =>  $s->slug,
                'rating'        =>  $s->rating,
                'phone'         =>  $s->phone,
                'code'          =>  $s->code,
                'content'       =>  $s->content,
                'picture'       =>  $s->picture,
                'comments'      =>  $s->commentsCount,
                'favorites'     =>  $s->favoritesCount,
                'total'         =>  $s->total_consultations,
                'created_at'    =>  $s->created_at,
                'updated_at'    =>  $s->updated_at,
            ];
        }

        if( count($this->consultants) < 1 ) {
            $consultantsJson = json_decode(Audiotel::getConsultantsJson('all'));
            if( !is_null($consultantsJson) ) {
                foreach( $consultantsJson->list_consultants as $c) {

                    //  Si le consultant n'est pas présent en base de donnée, on l'enregistre
                    if( !array_key_exists(str_slug($c->pseudo), $soothsayers) ) {
                        $create = [
                            'slug'      =>  str_slug($c->pseudo),
                            'nickname'  =>  $c->pseudo,
                            'content'   =>  strlen($c->desc_audiotel) > 0 ? $c->desc_audiotel : $c->desc_cb,
                            'phone'     =>  $c->phone,
                            'code'      =>  strlen($c->code_direct) > 0 ? $c->code_direct : null,
                        ];

                        //  On récupère sa photo
                        if( !is_null($c->photo) ) {
                            $picturePath = explode('/', $c->photo);
                            //Utils::uploadPicture($c->picture, end($picturePath), 'uploads/soothsayers');
                            file_put_contents(public_path('uploads/soothsayers/' . end($picturePath)), file_get_contents($c->photo));
                            $create = array_add($create, 'picture', end($picturePath));
                        }

                        $consultationsJson = json_decode(Audiotel::getConsultationsByConsultant($c->pseudo));
                        $count = count($consultationsJson->list_time_slot);

                        if( is_numeric($count) && $count > 0 ) {
                            $create = array_add($create, 'total_consultations', $count);
                        }

                        Soothsayer::create($create);
                        $soothsayers[str_slug($c->pseudo)] = [
                            'nickname'  =>  $c->pseudo,
                            //'stars'     =>  0,
                            //'ratings'   =>  0,
                            'rating'    =>  0,
                            'picture'   =>  end($picturePath),
                        ];
                    } else {
                        //  On sauvegarde la photo, au cas où
                        $pictureExplode = explode('/', $c->photo);
                        if( $c->phone != $soothsayers[str_slug($c->pseudo)]['phone'] || $c->code_direct != $soothsayers[str_slug($c->pseudo)]['code'] || ($c->desc_audiotel != $soothsayers[str_slug($c->pseudo)]['content'] && $c->desc_cb != $soothsayers[str_slug($c->pseudo)]['content']) || end($pictureExplode) != $soothsayers[str_slug($c->pseudo)]['picture']) {
                            $soothsayer = Soothsayer::where('slug', str_slug($c->pseudo))->firstOrFail();
                            Utils::removeFile('uploads/soothsayers/' . $soothsayer->picture);
                            //Utils::uploadPicture($c->photo, end($pictureExplode), 'uploads/soothsayers');
                            file_put_contents(public_path('uploads/soothsayers/' . end($pictureExplode)), file_get_contents($c->photo));

                            $soothsayer->update([
                                'phone'     =>  $c->phone,
                                'content'   =>  strlen($c->desc_audiotel) > 0 ? $c->desc_audiotel : $c->desc_cb,
                                'code'      =>  strlen($c->code_direct) > 0 ? $c->code_direct : null,
                                'picture'   =>  end($pictureExplode),
                            ]);
                        }

                        //  Check pour récupérer le total de consultations
                        if( $soothsayers[str_slug($c->pseudo)]['updated_at'] > Date::now()->subDays(1) ) {
                            $consultationsJson = json_decode(Audiotel::getConsultationsByConsultant($c->pseudo));
                            $count = count($consultationsJson->list_time_slot);

                            if( $count != $soothsayers[str_slug($c->pseudo)]['total'] ) {
                                $soothsayer = Soothsayer::where('slug', str_slug($c->pseudo))->firstOrFail();
                                $soothsayer->update([
                                    'total_consultations'   =>  $count,
                                ]);
                            }
                        }
                    }

                    //  Ajouts des informations supplémentaires
                    $soothsayers[str_slug($c->pseudo)] = array_merge($soothsayers[str_slug($c->pseudo)], [
                        'email'         =>  $c->email,
                        'status_cb'     =>  $c->status_cb == 'DISPONIBLE' ? true : false,
                        'status_08'     =>  $c->status_08 == 'DISPONIBLE' ? true : false,
                        'tarif_cb'      =>  $c->tarif_cb,
                        'next_dispo_cb' =>  $c->next_dispo_cb,
                        'next_dispo_08' =>  $c->next_dispo_08,
                    ]);
                }
            }

            //  Tri de la liste des consultants
            $consultantsCollection = collect($soothsayers);
            $consultants = $consultantsCollection->sortByDesc(function($consultant, $key) {
                if( isset($consultant['status_08']) && $consultant['status_08'] ) {
                    return ($consultant['status_08'] ? 1000000 : 0) + $consultant['rating'];
                } else if( isset($consultant['status_cb']) && $consultant['status_cb'] ) {
                    return ($consultant['status_cb'] ? 1000000 : 0) + $consultant['rating'];
                }

                return $consultant['rating'];
            });

            $this->consultants = $consultants->all();
        }

        //  Derniers commentaires
        $comments = Cache::remember('comments_index', 10, function() {
            return Comment::orderBy('created_at', 'DESC')->with('user')->with('soothsayer')->with('horoscope')->take(4)->get();
        });

        //  Derniers Sujets
        $topics = Cache::remember('topics_index', 10, function() {
            return Discussion::orderBy('created_at', 'DESC')->with('user')->with('category')->take(4)->get();
        });

        //  Discussions "chaudes"
        $topicsHot = Cache::remember('topics_hot_index', 30, function() {
            return Discussion::orderBy('answered', 'DESC')->with('user')->with('category')->take(4)->get();
        });

        /**
         * Voyants favoris
         */
        $favorites = [];
        if( Auth::check() ) {
            foreach( Auth::user()->favoritesSoothsayers as $fav ) {
                $favorites[] = $this->consultants[$fav->slug];
            }
        }

        return view('pages.home', compact('comments', 'topics', 'topicsHot', 'favorites'))->with('consultants', $this->consultants);
    }

    /**
     * Vue d'une page
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('pages.page', compact('page'));
    }

    /**
     * Formulaire de contact
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Formulaire de contact
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postContact(ContactRequest $request)
    {
        Mail::to(config('successvoyance.contact'))->send(new ContactEmail($request));
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Votre message nous a correctement été transmis, nous tâcherons d\'y répondre dans un délai de 48h. Merci à vous',
            'clean'     =>  true,
            'to_clean'  =>  ['content', 'topic']
        ]);
    }

    public function recruitment()
    {
        $offers = Recruitment::latest()->get();
        return view('pages.recruitment', compact('offers'));
    }

    public function postRecruitment(RecruitmentRequest $request)
    {
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Votre candidature nous a correctement été transmise, nous tâcherons d\'y répondre dans les plus brefs délais. Merci de votre participation !',
        ]);
    }

    /**
     * Inscription à la newsletter
     *
     * @param NewsletterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function newsletter(NewsletterRequest $request)
    {
        $check = Newsletter::where('email', $request->input('newsletter_email'))->first();
        if( $check ) {
            return response()->json([
                'success'   =>  false,
                'alert'     =>  true,
                'message'   =>  'Votre adresse email est déjà enregistrée, vous êtes déjà inscrit à notre newsletter.'
            ]);
        }

        Newsletter::create([
            'email'         =>  $request->input('newsletter_email'),
            'user_id'       =>   is_null($request->user()) ? null : $request->user()->id,
        ]);

        if( !is_null($request->user()) && !$request->user()->can_newsletter ) {
            $request->user()->update(['can_newsletter' => true]);
        }

        return response()->json([
            'success'   =>  true,
            'clean'     =>  true,
            'to_clean'  =>  ['newsletter_email'],
            'alert'     =>  true,
            'message'   =>  'Merci de votre soutien ! Vous voici désormais abonné à notre newsletter !',
        ]);
    }

    /**
     * Page de désinscription de la newsletter
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unsuscribe()
    {
        return view('pages.unsuscribe');
    }

    /**
     * Désinscription de la newsletter
     *
     * @param UnsuscribeNewsletterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUnsuscribe(UnsuscribeNewsletterRequest $request)
    {
        $newsletter = Newsletter::where('email', $request->input('email'))->first();
        if( !$newsletter ) {
            return response()->json([
                'success'   =>  true,
                'alert'     =>  true,
                'message'   =>  'Votre adresse email ne fait pas partie de nos adresses emails enregistrées. Si vous pensez qu\'il s\'agit d\'une erreur, veuillez nous contacter.',
                'type'      =>  'warning'
            ]);
        }

        $newsletter->delete();
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Vous ne faîtes désormais plus parti de nos liste de diffusions.',
        ]);
    }

    /**
     * Page de recherche
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view('pages.search', [
            'pages'             =>  [],
            'soothsayers'       =>  [],
            'astrologicalSigns' =>  [],
            'searched'          =>  false
        ]);
    }

    /**
     * Résultat de la recherche
     *
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function postSearch(SearchRequest $request)
    {
        $pages = Page::search($request->input('search'))->take(10)->get();
        $soothsayers = Soothsayer::search($request->input('search'))->take(10)->get();
        $astrologicalSigns = AstrologicalSign::search($request->input('search'))->take(10)->get();

        if( $request->ajax() ) {
            return response()->json([
                'success'   =>  true,
                'content'   =>  view('components.search_results', compact('pages', 'soothsayers', 'astrologicalSigns'))->with('searched', true)->render(),
                'method'    =>  'html',
                'element'   =>  '#search-results'
            ]);
        }

        return view('pages.search', compact('pages', 'soothsayers', 'astrologicalsSigns'))->with('searched', true);
    }
}
