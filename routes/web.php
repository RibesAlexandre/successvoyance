<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['uses' => 'SiteController@index', 'as' => 'home']);

//  Connexion & Inscription
Auth::routes();

//  Utilisateurs non connectes
Route::group(['middleware' => 'guest', 'namespace' => 'Auth'], function() {
    Route::post('voyance-par-email/connexion', ['uses' => 'LoginController@signInTelling', 'as' => 'telling.signin']);
    Route::post('voyance-par-email/inscription', ['uses' => 'RegisterController@SignUpTelling', 'as' => 'telling.signup']);
});

//  Espace membre
Route::group(['prefix' => 'mon-compte', 'namespace' => 'Auth', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'AccountController@index', 'as' => 'account']);
    Route::get('/mes-informations', ['uses' => 'AccountController@edit', 'as' => 'account.edit']);
    Route::get('/mon-mot-de-passe', ['uses' => 'AccountController@password', 'as' => 'account.password']);
    Route::get('/supprimer-mon-compte', ['uses' => 'AccountController@delete', 'as' => 'account.delete']);

    Route::get('supprimer-avatar', ['uses' => 'AccountController@removePicture', 'as' => 'account.avatar.delete']);
    Route::delete('/supprimer-mon-compte', ['uses' => 'AccountController@destroy', 'as' => 'account.destroy']);

    Route::post('/mes-informations', ['uses' => 'AccountController@update', 'as' => 'account.update']);
    Route::post('/mon-mot-de-passe', ['uses' => 'AccountController@updatePassword', 'as' => 'account.password.update']);
    Route::post('/mes-preferences', ['uses' =>'AccountController@updatePrivacy', 'as' => 'account.privacy.update']);
    Route::post('mon-avatar', ['uses' => 'AccountController@updatePicture', 'as' => 'account.avatar.update']);

    Route::get('mes-emails', ['uses' => 'AccountController@emails', 'as' => 'account.emails']);
    Route::get('mes-emails/{identifier}', ['uses' => 'AccountController@email', 'as' => 'account.email']);
    Route::post('mes-emails/reponse', ['uses' => 'AccountController@emailPost', 'as' => 'account.email.post']);
});

//  Utilisateurs
Route::group(['prefix' => 'utilisateurs'], function() {
    Route::get('/', ['uses' => 'UsersController@index', 'as' => 'users.index']);
    Route::get('{id}', ['uses' => 'UsersController@show', 'as' => 'users.show']);
    Route::get('{id}/commentaires', ['uses' => 'UsersController@comments', 'as' => 'users.comments']);
    Route::get('{id}/messages', ['uses' => 'UsersController@posts', 'as' => 'users.posts']);
    Route::get('{id}/conversations', ['uses' => 'UsersController@topics', 'as' => 'users.topics']);
});

//  Formulaire de contact
Route::get('/contact', ['uses' => 'SiteController@contact', 'as' => 'contact.get']);
Route::post('/contact', ['uses' => 'SiteController@postContact', 'as' => 'contact.post']);

Route::get('recherche', ['uses' => 'SiteController@search', 'as' => 'search.get']);
Route::post('recherche', ['uses' => 'SiteController@postSearch', 'as' => 'search.post']);

//  Enregistrement dans la newsletter
Route::post('newsletter/inscription', ['uses' => 'SiteController@newsletter', 'as' => 'newsletter.post']);
Route::get('newsletter/desinscription', ['uses' => 'SiteController@unsuscribe', 'as' => 'newsletter.unsuscribe']);
Route::post('newsletter/desinscription', ['uses' => 'SiteController@postUnsuscribe', 'as' => 'newsletter.unsuscribe.post']);

Route::get('signes-astrologiques', ['uses' => 'SignsController@index', 'as' => 'signs.index']);
Route::get('signes-astrologiques/{sign}', ['uses' => 'SignsController@show', 'as' => 'signs.show']);
Route::get('signes-astrologiques/{sign}/horoscopes', ['uses' => 'SignsController@horoscopes', 'as' => 'signs.horoscopes']);
Route::get('signes-astrologiques/{sign}/horoscopes/{slug}', ['uses' => 'SignsController@horoscope', 'as' => 'signs.horoscope']);

//  Voyance
Route::get('voyance-par-email', ['uses' => 'TellingController@email', 'as' => 'telling.email']);
Route::post('voyance-par-email', ['uses' => 'TellingController@send', 'as' => 'telling.email.post']);
Route::get('voyance-par-telephone', ['uses' => 'TellingController@phone', 'as' => 'telling.phone']);

//  Voyants
Route::get('voyants', ['uses' => 'SoothsayersController@index', 'as' => 'soothsayers.index']);
Route::get('voyants/{slug}', ['uses' => 'SoothsayersController@show', 'as' => 'soothsayers.show']);
Route::get('voyants/{id}/comments', ['uses' => 'SoothsayersController@loadComments', 'as' => 'soothsayers.comments']);
Route::post('voyants/{id}/vote', ['uses' => 'SoothsayersController@rate', 'as' => 'soothsayers.rate']);
Route::get('voyants/{id}/favori', ['uses' => 'SoothsayersController@favorite', 'as' => 'soothsayers.favorite']);

//  Commentaires
Route::get('commentaire/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::post('commentaire', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::put('commentaire/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('commentaire/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);

//  Recrutement
Route::get('recrutement', ['uses' => 'Sitecontroller@recruitment', 'as' => 'recruitment']);
Route::post('recrutement', ['uses' => 'SiteController@postRecruitment', 'as' => 'recruitment.post']);

//  Formulaire de paiement
Route::post('paiment', ['uses'  =>  'PaymentController@process', 'as' => 'payment.process']);

//  Pages crées manuellement
Route::get('pages/{slug}', ['uses' => 'SiteController@page', 'as' => 'page']);
//  Forums
/*
Route::group(['prefix' => 'forum', 'namespace' => 'Forum'], function() {
    Route::get('/', ['uses' => 'ForumsController@index', 'as' => 'forum.index']);
    Route::get('/{forum}/', ['uses' => 'ForumsController@forum', 'as' => 'forum.forum']);
    Route::get('/{forum}/{topic}', ['uses' => 'TopicsController@topic', 'as' => 'forum.topic']);

    //  Sujets & Messages
    Route::resource('sujets', 'TopicsController', ['except' => ['index', 'show']]);
    Route::resource('messages', 'PostsController', ['except' => ['index', 'show']]);

    //  Modération
    Route::get('/moderate/{topic}', ['uses' => 'TopicsController@moderate']);
    Route::get('/moderate/{post}', ['uses' => 'PostsController@moderate']);
});
*/

/**
 * Administration
 */
Route::group(['prefix' => 'dashboard-123', 'namespace' => 'Admin'], function() {
//Route::group(['prefix' => 'dashboard-123', 'namespace' => 'Admin', 'middleware' => 'authorized'], function() {

    Route::get('/', ['uses' => 'DashBoardController@index', 'as' => 'admin.index']);

    /*
     * Gestion des rôles
     */
    Route::resource('roles', 'RolesController', ['names' => [
        'index'     =>  'admin.roles.index',
        'edit'      =>  'admin.roles.edit',
        'update'    =>  'admin.roles.update',
        'create'    =>  'admin.roles.create',
        'store'     =>  'admin.roles.store',
        'destroy'   =>  'admin.roles.destroy',
    ], 'except' => ['show']]);

    /**
     * Editeur de pages
     */
    Route::resource('pages', 'PagesController', ['names' => [
        'index'     =>  'admin.pages.index',
        'edit'      =>  'admin.pages.edit',
        'update'    =>  'admin.pages.update',
        'create'    =>  'admin.pages.create',
        'store'     =>  'admin.pages.store',
        'destroy'   =>  'admin.pages.destroy',
    ], 'except' => ['show']]);

    /**
     * Offres de voyance par email
     */
    Route::resource('voyance-emails', 'EmailsController', ['names' => [
        'index'     =>  'admin.emails.index',
        'edit'      =>  'admin.emails.edit',
        'update'    =>  'admin.emails.update',
        'create'    =>  'admin.emails.create',
        'store'     =>  'admin.emails.store',
        'destroy'   =>  'admin.emails.destroy',
    ], 'except' => ['show']]);

    Route::get('voyance-emails/liste', ['uses' => 'EmailsController@all', 'as' => 'admin.emails.all']);
    Route::get('voyance-emails/conversation/{identifier}', ['uses' => 'EmailsController@conversation', 'as' => 'admin.emails.conversation']);
    Route::post('voyance-emails/conversation/{identifier}', ['uses' => 'EmailsController@response', 'as' => 'admin.emails.response']);

    /*
     * Signes & Horoscopes
     */
    Route::get('signs', ['uses' => 'SignsController@index', 'as' => 'admin.signs.index']);
    Route::get('signs/create-sign', ['uses' => 'SignsController@createSign', 'as' => 'admin.signs.create_sign']);
    Route::post('signs/create-sign', ['uses' => 'SignsController@storeSign', 'as' => 'admin.signs.store_sign']);
    Route::get('horoscopes/create-horoscope', ['uses' => 'SignsController@createHoroscope', 'as' => 'admin.signs.create_horoscope']);
    Route::post('horoscopes/create-horoscope', ['uses' => 'SignsController@storeHoroscope', 'as' => 'admin.signs.store_horoscope']);
    Route::get('signs/{id}/edit-sign', ['uses' => 'SignsController@editSign', 'as' => 'admin.signs.edit_sign']);
    Route::patch('signs/{id}/edit-sign', ['uses' => 'SignsController@updateSign', 'as' => 'admin.signs.update_sign']);
    Route::get('horoscopes/{id}/edit-horoscope', ['uses' => 'SignsController@editHoroscope', 'as' => 'admin.signs.edit_horoscope']);
    Route::patch('horoscopes/{id}/edit-horoscope', ['uses' => 'SignsController@updateHoroscope', 'as' => 'admin.signs.update_horoscope']);
    Route::delete('signs/{id}', ['uses' => 'SignsController@destroySign', 'as' => 'admin.signs.destroy_sign']);
    Route::delete('horoscopes/{id}', ['uses' => 'SignsController@destroyHoroscope', 'as' => 'admin.signs.destroy_horoscope']);
    Route::get('signs/{slug}', ['uses' => 'SignsController@show', 'as' => 'admin.signs.show']);

    /*
     * Gestion des utilisateurs
     */
    Route::get('users', ['uses' => 'UsersController@index', 'as' => 'admin.users.index']);
    Route::get('users/{id}', ['uses' => 'UsersController@show', 'as' => 'admin.users.show']);
    Route::put('users/{id}', ['uses' => 'UsersController@update', 'as' => 'admin.users.update']);
    Route::get('newsletter', ['uses' => 'UsersController@newsletter', 'as' => 'admin.newsletter']);
    Route::get('newsletter/dl', ['uses' => 'UsersController@download', 'as' => 'admin.newsletter.dl']);

    /**
     * Gestion des éléments du site
     */
    Route::group(['prefix' => 'management'], function() {
        Route::get('/', ['uses' => 'ManagerController@index', 'as' => 'admin.manager.index']);
        Route::get('link/{id}', ['uses' => 'ManagerController@link', 'as' => 'admin.manager.link']);
        Route::get('links/create', ['uses' => 'ManagerController@createLink', 'as' => 'admin.manager.create_link']);
        Route::post('links/create', ['uses' => 'ManagerController@storeLink', 'as' => 'admin.manager.store_link']);
        Route::get('links/{id}/edit', ['uses' => 'ManagerController@editLink', 'as' => 'admin.manager.edit_link']);
        Route::patch('links/{id}/edit', ['uses' => 'ManagerController@updateLink', 'as' => 'admin.manager.update_link']);
        Route::get('order/{id}/{asc}/{type}', ['uses' => 'ManagerController@order', 'as' => 'admin.manager.order']);
        Route::delete('links/{id}', ['uses' => 'ManagerController@destroyLink', 'as' => 'admin.manager.destroy_link']);

        Route::get('carousels/create', ['uses' => 'ManagerController@createCarousel', 'as' => 'admin.manager.create_carousel']);
        Route::post('carousels/create', ['uses' => 'ManagerController@storeCarousel', 'as' => 'admin.manager.store_carousel']);
        Route::get('carousels/{id}/edit', ['uses' => 'ManagerController@editCarousel', 'as' => 'admin.manager.edit_carousel']);
        Route::patch('carousels/{id}/edit', ['uses' => 'ManagerController@updateCarousel', 'as' => 'admin.manager.update_carousel']);
        Route::delete('carousels/{id}', ['uses' => 'ManagerController@destroyCarousel', 'as' => 'admin.manager.destroy_carousel']);

        Route::post('config', ['uses' => 'ManagerController@updateConfig', 'as' => 'admin.manager.update_config']);
    });

    //  Gestion des médias
    Route::get('pictures/destroy', ['uses' => 'PicturesController@destroy', 'as' => 'admin.pictures.destroy']);
    Route::post('pictures/upload', ['uses' => 'PicturesController@upload', 'as' => 'admin.pictures.upload']);
});

//  Pages du site
Route::get('pages/{slug}', ['uses' => 'SiteController@page', 'as' => 'page']);