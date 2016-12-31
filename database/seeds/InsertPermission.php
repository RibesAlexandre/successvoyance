<?php

use Illuminate\Database\Seeder;

use App\Models\Permission;

class InsertPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'      =>  'Consulter la liste des rôles',
            'slug'      =>  'index_roles',
            'section'   =>  'roles',
        ]);

        Permission::create([
            'name'      =>  'Créer un rôle',
            'slug'      =>  'create_role',
            'section'   =>  'roles',
        ]);

        Permission::create([
            'name'      =>  'Modifier un rôle',
            'slug'      =>  'edit_role',
            'section'   =>  'roles',
        ]);

        Permission::create([
            'name'      =>  'Supprimer un rôle',
            'slug'      =>  'destroy_role',
            'section'   =>  'roles',
        ]);

        Permission::create([
            'name'      =>  'Consulter la liste des utilisateurs',
            'slug'      =>  'index_users',
            'section'   =>  'users',
        ]);

        Permission::create([
            'name'      =>  'Créer un utilisateur',
            'slug'      =>  'create_users',
            'section'   =>  'users',
        ]);

        Permission::create([
            'name'      =>  'Modifier un utilisateur',
            'slug'      =>  'edit_users',
            'section'   =>  'users',
        ]);

        Permission::create([
            'name'      =>  'Supprimer un utilisateur',
            'slug'      =>  'destroy_users',
            'section'   =>  'users',
        ]);
    }
}
