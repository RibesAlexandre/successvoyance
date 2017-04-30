<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Comment;
use App\Models\Soothsayer;
use Illuminate\Http\Request;

/**
 * Class SoothsayersController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class SoothsayersController extends Controller
{
    /**
     * Liste des voyants
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $soothsayers = Soothsayer::orderBy('nickname', 'ASC')->get();
        return view('soothsayers.index', compact('soothsayers'));
    }

    /**
     * Affichage d'un voyant
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $soothsayer = Soothsayer::with('commentsCount')->with('favoritesCount')->where('slug', $slug)->firstOrFail();
        $comments = Comment::with('user')->where('soothsayer_id', $soothsayer->id)->latest()->take(10)->get();

        return view('soothsayers.show', compact('soothsayer', 'comments'))->with('favorites', Auth::user()->favoritesSoothsayers()->pluck('soothsayers.id')->all());
    }

    /**
     * Voir les commentaires du voyant
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadComments($id, Request $request)
    {
        $comments = Comment::with('user')->where('soothsayer_id', $id)->skip($request->get('skip'))->take(10)->get();
        return response()->json([
            'success'   =>  true,
            'content'   =>  count($comments) > 0 ? view('components.comments.comments', compact('comments'))->render() : view('components.box_icon', ['icon' => 'fa-comments', 'title' => 'Aucun commentaire', 'content' => 'Il n\'y a plus de commentaires à charger.'])->render(),
            'href'      =>  route('soothsayers.comments', ['id' => $id]) . '?skip=' . ($request->get('skip') + count($comments)),
            'method'    =>  'before',
            'element'   =>  '#more-comments',
            'count'     =>  count($comments),
        ]);
    }

    /**
     * Permet d'ajouter ou de retirer un voyant de ses favoris
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function favorite($id)
    {
        $soothsayer = Soothsayer::findOrFail($id);
        $favorites = Auth::user()->favoritesSoothsayers()->pluck('soothsayers.id')->all();

        if( in_array($soothsayer->id, $favorites) ) {
            $add = false;
            Auth::user()->favoritesSoothsayers()->detach($soothsayer->id);
        } else {
            $add = true;
            Auth::user()->favoritesSoothsayers()->attach($soothsayer->id);
        }

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  $soothsayer->nickname . ($add ?  ' fait désormais partie de vos voyant(e)s préféré(e)s !' : ' ne fait désormais plus parti(e) de vos voyant(e)s préféré(e)s'),
        ]);
    }

    /**
     * Vote pour un voyant
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rate(Request $request)
    {
        $soothsayer = Soothsayer::findOrFail($request->get('id'));
        $rating = Rating::where('user_id', Auth::id())->where('soothsayer_id', $soothsayer->id)->first();
        if( $rating ) {

            if( $rating->created_at >= Date::now()->subMinutes(15) ) {
                return response()->json([
                    'success'   =>  false,
                    'alert'     =>  'Vous avez déjà attribué une note à ' . $soothsayer->nickname . ' il y a plus de 5 minutes, vous ne pouvez changer votre évaluation.',
                    'type'      =>  'error',
                ]);
            }

            $rating->destroy();
            DB::table('soothsayers')->where('soothsayer_id', $soothsayer->id)->decrement('ratings', 1);
            DB::table('soothsayers')->where('soothsayer_id', $soothsayer->id)->decrement('stars', $request->get('stars'));
            $ratings = Soothsayer::select('stars', 'ratings')->where('id', $soothsayer->id)->firstOrFail();

            return response()->json([
                'success'   =>  true,
                'rating'    =>  str_limit(Utils::percent($ratings->stars, $ratings->ratings), 1, ''),
            ]);
        }

        $soothsayer->ratings()->create([
            'user_id'   =>  $request->user()->id,
            'stars'     =>  $request->get('stars'),
        ]);
        DB::table('soothsayers')->where('soothsayer_id', $soothsayer->id)->increment('ratings', 1);
        DB::table('soothsayers')->where('soothsayer_id', $soothsayer->id)->increment('stars', $request->get('stars'));
        $ratings = Soothsayer::select('stars', 'ratings')->where('id', $soothsayer->id)->firstOrFail();

        return response()->json([
            'success'   =>  true,
            'rating'    =>  str_limit(Utils::percent($ratings->stars, $ratings->ratings), 1, ''),
        ]);
    }
}
