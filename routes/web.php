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

//  Espace membre
Route::group(['prefix' => 'mon-compte', 'namespace' => 'Auth', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'AccountController@index', 'as' => 'account']);
    Route::get('/mes-informations', ['uses' => 'AccountController@edit', 'as' => 'account.edit']);
    Route::get('/mon-mot-de-passe', ['uses' => 'AccountController@password', 'as' => 'account.password']);
    Route::get('/supprimer-mon-compte', ['uses' => 'AccountController@delete', 'as' => 'account.delete']);
    Route::put('/mes-informations', ['uses' => 'AccountController@update', 'as' => 'account.update']);
    Route::put('/mon-mot-de-passe', ['uses' => 'AccountController@updatePassword', 'as' => 'account.password.update']);
    Route::put('/supprimer-mon-compte', ['uses' => 'AccountController@destroy', 'as' => 'account.destroy']);
});

//  Formulaire de contact
Route::get('/contact', ['uses' => 'SiteController@contact', 'as' => 'contact.get']);
Route::post('/contact', ['uses' => 'SiteController@postContact', 'as' => 'contact.post']);

//  Enregistrement dans la newsletter
Route::post('newsletter', ['uses' => 'SiteController@postNewsletter', 'as' => 'newsletter.post']);

Route::get('/signes-astrologiques', ['uses' => 'SignsController@index', 'as' => 'signs.index']);
Route::get('/signes-astrologiques/{sign}', ['uses' => 'SignsController@sign', 'as' => 'signs.show']);
Route::get('/signes-astrologiques/{sign}/horoscopes', ['uses' => 'SignsController@horoscopes']);

//  Voyance
Route::get('/voyance-par-email', ['uses' => 'TellingController@email', 'as' => 'telling.email']);
Route::get('/voyance-par-telephone', ['uses' => 'TellingController@phone', 'as' => 'telling.phone']);

//  Forums
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

/**
 * Administration
 */
Route::group(['prefix' => 'dashboard-123', 'namespace', 'App\Http\Controllers\Admin'], function() {

});
