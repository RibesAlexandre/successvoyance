<?php
namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class RolesController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class RolesController extends Controller
{
    /**
     * Liste des rôles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Création d'un nouveau rôle
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $role = new Role();
        $permissionsData = Permission::orderBy('section', 'ASC')->get();
        $permissionsIds = [];

        $permissions = collect($permissionsData);
        $sectionsCollection = $permissions->pluck('section')->all();
        $uniqueSections = collect($sectionsCollection);
        $sections = $uniqueSections->unique();

        return view('admin.roles.create', compact('role', 'sections', 'permissions', 'permissionsIds'));
    }

    /**
     * Enregistrement d'un rôle
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $permissions = [];
        if( $request->has('permissions') ) {
            foreach( $request->input('permissions') as $p ) {
                $permissions[] = $p;
            }
            $role->permissions()->sync($permissions);
        }

        return redirect()->route('admin.roles.index');
    }

    /**
     * Edition d'un rôle
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissionsData = Permission::orderBy('section', 'ASC')->get();
        $permissionsIds = [];
        foreach( $role->permissions as $p ) {
            $permissionsIds[] = $p->id;
        }

        $permissions = collect($permissionsData);
        $sectionsCollection = $permissions->pluck('section')->all();
        $uniqueSections = collect($sectionsCollection);
        $sections = $uniqueSections->unique();

        return view('admin.roles.edit', compact('role', 'sections', 'permissions', 'permissionsIds'));
    }

    /**
     * Mise à jour d'un rôle
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());

        $permissions = [];
        foreach( $request->input('permissions') as $p )
        {
            $permissions[] = $p;
        }
        $role->permissions()->sync($permissions);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Suppression d'un rôle
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json([
            'success'   =>  true,
            'message'   =>  'Le Rôle a correctement été supprimé.'
        ]);
    }
}
