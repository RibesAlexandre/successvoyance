<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\User\LoginRequest;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Class LoginController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Formulaire de connexion pour la voyance par email
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signInTelling(LoginRequest $request)
    {
        if( !Auth::attempt(['email' => $request->input('email_login'), 'password' => $request->input('password_login')], true) ) {
            return response()->json([
                'success'   =>  false,
                'clean'     =>  true,
                'to_clean'  =>  ['email_login', 'password_login'],
                'alert'     =>  true,
                'message'   =>  'Vos identifiants ne correspondent pas.',
            ]);
        }

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Vous êtes maintenant connecté ! Vous allez être redirigé dans 5 secondes',
            'redirect'  =>  route('telling.email') . $request->has('email_id_login') ? '?email=' . $request->input('email_id_login') : '',
        ]);
    }
}
