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

    Route::get('/', 'HomeController@index')->name('home');


    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/account/add', 'EveSSOController@login')->name('sso.login');
        Route::get('/eve/callback', 'EveSSOController@handle_callback')->name('sso.callback');
    });

    // admin
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
        Route::get('/', 'CorporationController@index')->name('corporation.index');
        Route::post('/corporation/add', 'CorporationController@store')->name('corporation.store');
    });

    // character
    Route::group(['prefix' => 'characters', 'namespace' => 'Character'], function() {
        Route::get('/', 'CharacterController@index')->name('characters.index');
    });

    // services
    Route::group(['prefix' => 'services', 'namespace' => 'Service'], function() {
        Route::get('/discord', 'DiscordController@index')->name('services.discord.index');
        Route::get('/discord/redirect', 'DiscordController@create')->name('services.discord.redirect');
        Route::get('/discord/callback', 'DiscordController@store')->name('services.discord.callback');

        Route::get('/reddit', 'RedditController@index')->name('services.reddit.index');
        Route::get('/reddit/redirect', 'RedditController@create')->name('services.reddit.redirect');
        Route::get('/reddit/callback', 'RedditController@store')->name('services.reddit.callback');
    });



});


Route::get('/debug', 'HomeController@debug');