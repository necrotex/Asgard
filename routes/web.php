<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home')->middleware(['finished-account']);

    Route::post('/search', 'SearchController@search')->name('search');


    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/account/add', 'EveSSOController@login')->name('sso.login');
        Route::get('/eve/callback', 'EveSSOController@handle_callback')->name('sso.callback');
    });

    // admin
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'finished-account'], function() {
        Route::get('/corporation', 'CorporationController@index')->name('corporation.index');
        Route::post('/corporation/add', 'CorporationController@store')->name('corporation.store');
        Route::get('/corporation/{id}', 'CorporationController@show')->name('corporation.show');
        Route::post('/corporation/{corp}/update', 'CorporationController@update')->name('corporation.update');


        //roles
        Route::get('/roles', 'RoleController@index')->name('roles.index');
        Route::get('/roles/create', 'RoleController@create')->name('roles.create');
        Route::post('/roles/store', 'RoleController@store')->name('roles.store');
        Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
        Route::post('/roles/{role}/update', 'RoleController@update')->name('roles.update');
    });

    // character
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {
        Route::get('/{id}/characters', 'CharacterController@show')->name('characters.index');

        Route::get('{user}/profile', 'ProfileController@show')->name('profile.show');
        Route::post('{user}/profile/update', 'ProfileController@update')->name('profile.update');
    });


    // services
    Route::group(['prefix' => 'services', 'namespace' => 'Service', 'middleware' => 'finished-account'], function() {
        Route::get('/discord', 'DiscordController@index')->name('services.discord.index');
        Route::get('/discord/redirect', 'DiscordController@create')->name('services.discord.redirect');
        Route::get('/discord/callback', 'DiscordController@store')->name('services.discord.callback');

        Route::get('/reddit', 'RedditController@index')->name('services.reddit.index');
        Route::get('/reddit/redirect', 'RedditController@create')->name('services.reddit.redirect');
        Route::get('/reddit/callback', 'RedditController@store')->name('services.reddit.callback');
    });






});


Route::get('/debug', 'HomeController@debug');