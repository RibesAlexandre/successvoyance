<?php
namespace App\Http\Controllers;

use App\Models\AstrologicalSign;
use App\Models\Horoscope;
use Illuminate\Http\Request;

/**
 * Class SignsController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class SignsController extends Controller
{
    /**
     * Liste des signes astrologiques
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->get();
        return view('telling.signs', compact('signs'));
    }

    /**
     * Vue d'un signe astrologique
     *
     * @param $sign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($sign)
    {
        $sign = AstrologicalSign::where('slug', $sign)->firstOrFail();
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->get();
        $horoscope = Horoscope::where('sign_id', $sign->id)->latest()->first();
        return view('telling.sign', compact('sign', 'signs', 'horoscope'));
    }

    /**
     * Liste des horoscopes du signe
     *
     * @param $sign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function horoscopes($sign)
    {
        $sign = AstrologicalSign::where('slug', $sign)->firstOrFail();
        $horoscopes = Horoscope::where('sign_id', $sign->id)->latest()->paginate(6);
        return view('telling.horoscopes', compact('sign', 'horoscopes'));
    }

    /**
     * Vue d'un horoscope
     *
     * @param $sign
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function horoscope($sign, $slug)
    {
        $sign = AstrologicalSign::where('slug', $sign)->firstOrFail();
        $horoscope = Horoscope::where('slug', $slug)->firstOrFail();
        return view('telling.horoscope', compact('sign', 'horoscope'));
    }
}
