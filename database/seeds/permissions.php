<?php

use Illuminate\Database\Seeder;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'name'  =>  'Administrateur',
            'slug'  =>  'admin',
        ]);

        \App\Models\Role::create([
            'name'  =>  'Voyant',
            'slug'  =>  'voyant'
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Voir Configuration',
            'slug'      =>  'manager_index',
            'content'   =>  'Voir la page de configuration',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Gérer les liens',
            'slug'      =>  'manager_link',
            'content'   =>  'Voir la configuration des liens',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer des liens',
            'slug'      =>  'manager_create_link',
            'content'   =>  'Créer de nouveaux liens',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Modifier des liens',
            'slug'      =>  'manager_edit_link',
            'content'   =>  'Modifier des liens existants',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer des liens',
            'slug'      =>  'manager_destroy_link',
            'content'   =>  'Supprimer des liens existants',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Ordonner les liens',
            'slug'      =>  'manager_order_link',
            'content'   =>  'Ordonner les liens existants',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer des carousels',
            'slug'      =>  'manager_create_carousel',
            'content'   =>  'Créer de nouveaux carousels pour le site',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Modifier des carousels',
            'slug'      =>  'manager_edit_carousel',
            'content'   =>  'Mettre à jour les carousels existants.',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer des carousels',
            'slug'      =>  'manager_destroy_carousel',
            'content'   =>  'Supprimer des carousels existants',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Mettre à jour la configuration',
            'slug'      =>  'manager_update_config',
            'content'   =>  'Mettre à jour la configuration du site',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Uploader des images globales',
            'slug'      =>  'manager_upload',
            'content'   =>  'Permettre de pouvoir uploader des images dans la configuration',
            'section'   =>  'management',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Uploader des images',
            'slug'      =>  'pictures_upload',
            'content'   =>  'Permettre de pouvoir uploader des images pour des éléments comme pages, horoscopes, signes astrologiques...',
            'section'   =>  'pictures',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer des images',
            'slug'      =>  'pictures_destroy',
            'content'   =>  'Permettre de pouvoir supprimer des images sur des signes astrologiques, horoscopes, pages, etc.',
            'section'   =>  'pictures',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Voir les utilisateurs',
            'slug'      =>  'users_index',
            'content'   =>  'Permettre de consulter la liste des utilisateurs',
            'section'   =>  'users',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Voir la fiche d\'un utilisateur',
            'slug'      =>  'users_show',
            'content'   =>  'Permettre de consulter la fiche d\'un utilisateur',
            'section'   =>  'users',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Mettre à jour un utilisateur',
            'slug'      =>  'users_update',
            'content'   =>  'Permettre de modifier un utilisateur',
            'section'   =>  'users',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Consulter les inscrits à la newsletter',
            'slug'      =>  'newsletter',
            'content'   =>  'Consulter la lite des inscrits à la newsletter',
            'section'   =>  'users',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Télécharger la liste des inscrits newsletter',
            'slug'      =>  'newsletter_dl',
            'content'   =>  'Permettre de télécharger le fichier CSV des inscrits à la newsletter',
            'section'   =>  'users',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Voir les signes astrologiques & horoscopes',
            'slug'      =>  'signs_index',
            'content'   =>  'Permettre de consulter la liste des signes astrologiques',
            'section'   =>  'signs',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer un signe astrologique',
            'slug'      =>  'signs_create_sign',
            'content'   =>  'Permettre de créer de nouveaux signes astrologiques',
            'section'   =>  'signs',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer des horoscopes',
            'slug'      =>  'signs_create_horoscope',
            'content'   =>  'Permettre de créer de nouveaux horoscopes',
            'section'   =>  'signs',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Modifier des signes astrologiques',
            'slug'      =>  'signs_edit_horoscope',
            'content'   =>  'Permettre de modifier des signes astrologiques',
            'section'   =>  'signs',
        ]);


        \App\Models\Permission::create([
            'name'      =>  'Supprimer des horoscopes',
            'slug'      =>  'signs_destroy_horoscope',
            'content'   =>  'Permettre de supprimer des horoscopes',
            'section'   =>  'signs',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer des signes astrologiques',
            'slug'      =>  'signs_destroy_sign',
            'content'   =>  'Permettre de supprimer des signes astrologiques',
            'section'   =>  'signs',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Consulter les offres de voyance email',
            'slug'      =>  'emails_index',
            'content'   =>  'Permettre de consulter les offres de voyance emails',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer de nouvelles offres de voyance email',
            'slug'      =>  'emails_create',
            'content'   =>  'Permettre de créer de nouvelles offres de voyance par email',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Modifier des offres de voyance email',
            'slug'      =>  'emails_edit',
            'content'   =>  'Permettre de modifier les offres de voyance par email',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer des offres de voyance email',
            'slug'      =>  'emails_destroy',
            'content'   =>  'Permettre de supprimer des offres de voyance par email',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Consulter les emails de voyance reçus',
            'slug'      =>  'emails_all',
            'content'   =>  'Permettre de consulter la liste des emails de voyance reçus',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Lire une conversation d\'email de voyance',
            'slug'      =>  'emails_conversation',
            'content'   =>  'Permettre de consulter une conversation d\'email de voyance',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Répondre à un email de voyance reçu',
            'slug'      =>  'emails_response',
            'content'   =>  'Permettre de répondre à un email de voyance reçu',
            'section'   =>  'emails',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Consulter la liste desPages',
            'slug'      =>  'pages_index',
            'content'   =>  'Permettre de consulter la liste des pages',
            'section'   =>  'pages',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer de nouvelles Pages',
            'slug'      =>  'pages_create',
            'content'   =>  'Permettre de créer de nouvelles pages texte sur le site',
            'section'   =>  'pages',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Modifier des Pages existantes',
            'slug'      =>  'pages_edit',
            'content'   =>  'Permettre de mettre à jour des pages texte existantes.',
            'section'   =>  'pages',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer des Pages',
            'slug'      =>  'pages_destroy',
            'content'   =>  'Permettre de supprimer des pages textes existantes',
            'section'   =>  'pages',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Consuler les Roles',
            'slug'      =>  'roles_index',
            'content'   =>  'Permettre de consulter la liste des rôles admin',
            'section'   =>  'roles',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Créer de nouveaux Rôles',
            'slug'      =>  'roles_create',
            'content'   =>  'Permettre de créer de nouveaux rôles',
            'section'   =>  'roles',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Mettre à jour des Rôles',
            'slug'      =>  'roles_edit',
            'content'   =>  'Permettre de mettre à jour des rôles existants.',
            'section'   =>  'roles',
        ]);

        \App\Models\Permission::create([
            'name'      =>  'Supprimer desRoles',
            'slug'      =>  'roles_destroy',
            'content'   =>  'Permettre de supprimer des rôles existants',
            'section'   =>  'roles',
        ]);

        $role = \App\Models\Role::where('slug', 'admin')->first();
        $permissions = \App\Models\Permission::pluck('id')->all();
        $role->permissions()->attach($permissions);

        $userOne = \App\Models\User::findOrFail(1);
        $userOne->roles()->attach(1);

        $userTwo = \App\Models\User::findOrFail(2);
        $userTwo->roles()->attach(2);
    }
}
