<?php

namespace App\Http\Controllers\Auth;

//  Requests
use App\Http\Requests\User\EditAccountRequest;
use App\Http\Requests\User\EditPasswordRequest;
use App\Http\Requests\User\EditPictureRequest;

use Auth;
use Illuminate\Http\Request;
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
        return view('auth.account.index')->with('user', Auth::user());
    }

    /**
     * Edition des informations de l'utilisateur
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('auth.account.parameters')->with('user', Auth::user());
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
        $pictureName = str_slug(Auth::user()->nickname) . '.' . $picture->getClientOriginalExtension();
        $image = Image::make($picture);
        //$image->resize(100, 100);
        $picture->move(public_path('uploads/avatars'), $pictureName);
        //$image->save(public_path('uploads/avatars'), $pictureName);
        Auth::user()->update([
            'avatar'    =>  $pictureName,
        ]);

        return response()->json([
            'success'   =>  true,
            'content'   =>  '<img class="img-responsive" src="' . Auth::user()->avatar() .  '" alt="Votre image de profil" />',
            'element'   =>  '#picture',
            'method'    =>  'html',
            'timer'     =>  2000,
        ]);
    }

    /**
     * Permet à l'utilsateur de supprimer sa photo de profil
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removePicture()
    {
        if( !is_null(Auth::user()->avatar) ) {
            if( is_file(public_path('uploads/avatars/' . Auth::user()->avatar)) ) {
                unlink(public_path('uploads/avatars/' . Auth::user()->avatar));
            }

            Auth::user()->update(['avatar' => null]);

            return response()->json([
                'success'   =>  true,
                'content'   =>  '<img class="img-responsive" src="' . asset('imgs/components/default-avatar.png') .  '" alt="Votre image de profil" />',
                'element'    =>  '#picture',
                'method'    =>  'html'
            ]);
        }

        return response()->json([
            'success'       =>  true,
            'alert'         =>  true,
            'message'       =>  'Vous ne possédez actuellement aucune image de profil !',
            'type'          =>  'error'
        ]);
    }

    /**
     * Mert à jour les préférences de l'utilisateur
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePrivacy(Request $request)
    {
        Auth::user()->update($request->all());
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Vos préférences ont correctement été mises à jour.'
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
