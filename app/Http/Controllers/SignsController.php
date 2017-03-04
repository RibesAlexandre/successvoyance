<?php

namespace App\Http\Controllers;

use App\Models\AstrologicalSign;
use Illuminate\Http\Request;

class SignsController extends Controller
{
    public function index()
    {
        $signs = AstrologicalSign::orderBy('begin_at', 'ASC')->get();
        return view('telling.signs', compact('signs'));
    }

    public function show($slug)
    {
        $sign = AstrologicalSign::with('lastHoroscope')->where('slug', $slug)->firstOrFail();
        return view('telling.sign', compact('sign'));
    }
}
