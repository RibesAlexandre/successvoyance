<?php
namespace App\Http\Controllers\Admin;

//  Models
use App\Http\Requests\Admin\CreateEditHoroscopeRequest;
use App\Models\Horoscope;
use App\Models\AstrologicalSign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//  Utils
use Sync;
use Date;

/**
 * Class SignsController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class SignsController extends Controller
{
    /**
     * Liste des signes astrologiques & horoscopes
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->get();
        $horoscopes = Horoscope::latest()->paginate(12);
        return view('admin.signs.index', compact('signs', 'horoscopes'));
    }

    /**
     * Vue d'un signe astrologique
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $sign = AstrologicalSign::with('horoscopes')->where('slug', $slug)->firstOrFail();
        $horoscopes = Horoscope::where('sign_id', $sign->id)->paginate(12);
        return view('admin.signs.show', compact('sign', 'horoscopes'));
    }

    /**
     * Création d'un signe astrologique
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createSign()
    {
        $sign = new AstrologicalSign();
        return view('admin.signs.create_sign', compact('sign'));
    }

    /**
     * Sauvegarde d'un signe astrologique
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSign(Request $request)
    {
        $inputs = $request->all();
        if( $request->hasFile('logo') ) {
            $logoName = str_slug($request->input('name')) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->store(public_path('uploads/signs'), $logoName);
            $inputs = array_add($inputs, 'logo', $logoName);
        }

        $sign = AstrologicalSign::create($inputs);
        Sync::syncPictures($sign, $request);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Votre signe astrologique a correctement été créée ! Vous allez être redirigé dans 3 secondes',
            'timer'     =>  3000,
            'redirect'  =>  route('admin.signs.index'),
        ]);
    }

    /**
     * Edition d'un signe astrologique
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSign($id)
    {
        $sign = AstrologicalSign::findOrFail($id);
        return view('admin.signs.edit_sign', compact('sign'));
    }

    /**
     * Mise à jour d'un signe astrologique
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSign($id, Request $request)
    {
        $inputs = $request->all();
        $sign = AstrologicalSign::findOrFail($id);
        if( $request->hasFile('logo') ) {
            //  On supprime l'ancien logo
            if( !is_null($sign->logo) && is_file(public_path('uploads/signs/' . $sign->logo)) ) {
                unlink(public_path('uploads/signs/' . $sign->logo));
            }

            $logoName = str_slug($request->input('name')) . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->store(public_path('uploads/signs'), $logoName);
            $inputs = array_add($inputs, 'logo', $logoName);
        }

        Sync::syncPictures($sign, $request);
        $sign->update($inputs);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Votre signe astrologique a correctement été mis à jour ! Vous allez être redirigé dans 3 secondes',
            'timer'     =>  3000,
            'redirect'  =>  route('admin.signs.index'),
        ]);
    }

    /**
     * Création d'un nouvel horoscope
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createHoroscope(Request $request)
    {
        $horoscope = new Horoscope();
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->pluck('name', 'id');
        if( $request->has('sign') ) {
            $sign = AstrologicalSign::where('slug', $request->get('sign'))->firstOrFail();
            $horoscope->sign_id = $sign->id;
        }

        return view('admin.signs.create_horoscope', compact('horoscope', 'signs'));
    }

    /**
     * Sauvegarde d'un horoscope
     *
     * @param CreateEditHoroscopeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeHoroscope(CreateEditHoroscopeRequest $request)
    {
        $inputs = $request->all();
        $inputs['slug'] = str_slug($request->input('name')) . '-' . Date::parse($request->input('begin_at'))->format('d-m-Y') . '-' .  Date::parse($request->input('ending_at'))->format('d-m-Y');
        $horoscope = Horoscope::create($inputs);
        Sync::syncPictures($horoscope, $request);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Votre horoscope a correctement été publié ! Vous allez être redirigé dans 3 secondes',
            'timer'     =>  3000,
            'redirect'  =>  route('admin.signs.index'),
        ]);
    }

    /**
     * Edition d'un horoscope
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editHoroscope($id)
    {
        $horoscope = Horoscope::findOrFail($id);
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->pluck('name', 'id');
        return view('admin.signs.edit_horoscope', compact('horoscope', 'signs'));
    }

    /**
     * Mise à jour d'un horoscope
     *
     * @param $id
     * @param CreateEditHoroscopeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateHoroscope($id, CreateEditHoroscopeRequest $request)
    {
        $horoscope = Horoscope::findOrFail($id);
        $inputs = $request->all();
        $inputs['slug'] = str_slug($request->input('name')) . '-' . Date::parse($request->input('begin_at'))->format('d-m-Y') . '-' .  Date::parse($request->input('ending_at'))->format('d-m-Y');
        $horoscope->update($inputs);
        Sync::syncPictures($horoscope, $request);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Votre horoscope a correctement été mis à jour ! Vous allez être redirigé dans 3 secondes',
            'timer'     =>  3000,
            'redirect'  =>  route('admin.signs.index'),
        ]);
    }

    /**
     * Suppression d'un signe astrologique
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroySign($id)
    {
        $sign = AstrologicalSign::findOrFail($id);
        $sign->delete();

        return response()->json([
            'success'   =>  true
        ]);
    }

    /**
     * Suppression d'un horoscope
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyHoroscope($id)
    {
        $horoscope = Horoscope::findOrFail($id);
        $horoscope->delete();

        return response()->json([
            'success'   =>  true
        ]);
    }

}
