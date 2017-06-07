<?php

namespace App\Http\Controllers\Auth;


//  Utils + Requests
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;

//  Auth + User
use Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          =>  'required|max:80',
            'firstname'     =>  'required|max:80',
            'nickname'      =>  'required|max:80|unique:users',
            'email'         =>  'required|email|max:255|unique:users',
            'password'      =>  'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        flash('Votre compte a correctement été créée ! Vous pouvez maintenant naviguer sur le site', 'success');

        return User::create([
            'name'      =>  $data['name'],
            'firstname' =>  $data['firstname'],
            'nickname'  =>  $data['nickname'],
            'email'     =>  $data['email'],
            'password'  =>  bcrypt($data['password']),
        ]);
    }

    /**
     * Inscription en mode libre
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUpTelling(RegisterRequest $request)
    {
        $user = User::create([
            'name'          =>  $request->input('name_register'),
            'firstname'     =>  $request->input('firstname_register'),
            'nickname'      =>  $request->input('nickname_register'),
            'email'         =>  $request->input('email_register'),
            'password'      =>  bcrypt($request->input('password_register')),
        ]);

        Auth::loginUsingId($user->id);
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Votre compte vient d\'être créée ! Vous allez être connecté et redirigé pour poursuivre.',
            'redirect'  =>  route('telling.email') . $request->has('email_id_register') ? '?email=' . $request->input('email_id_register') : '',
        ]);
    }
}
