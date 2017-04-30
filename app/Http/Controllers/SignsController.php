<?php
namespace App\Http\Controllers;

use App\Models\AstrologicalSign;
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
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $sign = AstrologicalSign::where('slug', $slug)->firstOrFail();
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->get();
        return view('telling.sign', compact('sign', 'signs'));
    }
}
