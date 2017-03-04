<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function update($id, EditUserRequest $request)
    {
        $user = User::findOrFail($id);
        $inputs = $request->all();

        if( !empty($inputs['password']) ) {
            $inputs['password'] = bcrypt($inputs['password']);
        } else {
            array_forget($inputs, 'password');
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
}
