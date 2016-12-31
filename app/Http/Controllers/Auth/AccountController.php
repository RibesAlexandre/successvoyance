<?php

namespace App\Http\Controllers\Auth;

//  Requests
use App\Http\Requests\User\EditAccountRequest;
use App\Http\Requests\User\EditPasswordRequest;
use App\Http\Requests\User\EditPictureRequest;

use Auth;
use Image;
use App\Models\User;
use App\Http\Controllers\Controller;

/**
 * Class AccountController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Auth
 */
class AccountController extends Controller
{
    /**
     * Accueil du profil
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.account.index');
    }

    /**
     * Edition des informations de l'utilisateur
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('auth.account.account');
    }

    /**
     * Soumission des nouvelles informations
     *
     * @param EditAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditAccountRequest $request)
    {
        Auth::user()->update($request->all());
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            //'content'   =>  view('components.infobox', ['type' => 'success', 'message' => 'Vos informations ont correctement été mises à jour.'])->render(),
            'inputs'    =>  $request->all(),
            'type'      =>  'success',
            'message'   =>  'Vos informations ont correctement été mises à jour',
        ]);
    }

    /**
     * Edition du mot de passe de l'utilisateur
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        return view('auth.account.password');
    }

    /**
     * Soumission du nouveau mot de passe de l'utilisateur
     *
     * @param EditPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(EditPasswordRequest $request)
    {
        if( !password_verify($request->input('old_password'), Auth::user()->password) ) {
            return response()->json([
                'success'   =>  true,
                'alert'     =>  true,
                //'content'   =>  view('components.infobox', ['type' => 'danger', 'message' => 'Votre ancien mot de passe ne correspond pas avec celui que nous possédons.'])->render(),
                'type'      =>  'error',
                'message'   =>  'Votre ancien mot de passe ne correspond pas avec celui que nous possédons.',
            ]);
        }

        Auth::user()->update([
            'password'  =>  bcrypt($request->input('password'))
        ]);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'clean'     =>  true,
            'to_clean'  =>  [
                'old_password',
                'password',
                'password_confirmation'
            ],
            //'content'   =>  view('components.infobox', ['type' => 'success', 'message' => 'Votre mot de passe a correctement été mis à jour'])->render(),
            'type'      =>  'success',
            'message'   =>  'Votre mot de passe a correctement été mis à jour.'
        ]);
    }

    /**
     * Enregistrement de la nouvelle photo de profil
     *
     * @param EditPictureRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePicture(EditPictureRequest $request)
    {
        //  Suppression de l'ancien avatar
        if( is_file(public_path('uploads/avatars/' . Auth::user()->avatar)) ) {
            unlink(public_path('uploads/avatars/' . Auth::user()->avatar));
        }

        $picture = $request->file('picture');
        $pictureName = str_slug(Auth::user()->full_name) . '.' . $picture->getClientOriginalExtension();
        $image = Image::make($picture);
        $image->resize(100, 100);
        $image->save(public_path('uploads/avatars'), $pictureName);
        Auth::user()->update([
            'avatar'    =>  $pictureName,
        ]);

        return response()->json([
            'success'   =>  true,
            'content'   =>  asset('uploads/avatar/' . $pictureName),
            'element'   =>  '#picture',
            'method'    =>  'html'
        ]);
    }

    /**
     * Page de suppression du compte
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete()
    {
        return view('auth.account.destroy');
    }

    /**
     * Suppression du compte de l'utilisateur
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        User::destroy(Auth::id());
        Auth::logout();
        return response()->json([
            'success'   =>  true,
            'content'   =>  view('components.infobox', ['type' => 'success', 'message' => 'Votre compte a correctement été supprimé'])->render()
        ]);
    }
}
