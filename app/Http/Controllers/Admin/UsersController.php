<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Newsletter;
use App\Models\Role;
use App\Models\Soothsayer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UsersController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class UsersController extends Controller
{
    /**
     * Liste des utilisateurs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('soothsayer')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Vue d'un utilisateur
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $soothsayers = Soothsayer::pluck('nickname', 'id');
        $soothsayers->prepend('Sélectionnez un voyant');
        $roles = Role::pluck('name', 'id');
        $userRoles = $user->roles()->pluck('id')->all();

        return view('admin.users.show', compact('user', 'soothsayers', 'roles', 'userRoles'));
    }

    /**
     * Mise à jour d'un utilisateur
     *
     * @param $id
     * @param EditUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, EditUserRequest $request)
    {
        $user = User::findOrFail($id);
        $inputs = $request->all();

        if( !empty($inputs['password']) ) {
            $inputs['password'] = bcrypt($inputs['password']);
        } else {
            array_forget($inputs, 'password');
        }

        if( $request->has('roles') ) {
            //$roles = $user->roles()->pluck('id')->all();
            $user->roles()->sync($request->input('roles'));
        }

        $user->update($inputs);
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'L\'utilisateur a correctement été mis à jour',
            'redirect'  =>  route('admin.users.index'),
            'type'      =>  'success'
        ]);
    }

    /**
     * Retourne la liste des emails disponibles
     */
    public function newsletter()
    {
        $users = User::select('email')->where('can_newsletter', true)->get();
        $newsletters = Newsletter::select('email')->get();

        $emails = [];
        foreach( $newsletters as $newsletter ) {
            if( !in_array($newsletter->email, $emails) ) {
                $emails[] = $newsletter->email;
            }
        }

        foreach( $users as $user ) {
            if( !in_array($user->email, $emails) ) {
                $emails[] = $user->email;
            }
        }

        $fp = fopen(public_path('uploads/emails_newsletter.csv'), 'w');
        fputcsv($fp, $emails);
        fclose($fp);

        return view('admin.users.newsletter', compact('emails'));
    }

    /**
     * Permet de télécharger le fichier CSV
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download()
    {
        return response()->download(public_path('uploads/emails_newsletter.csv'));
    }
}
