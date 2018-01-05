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

    Route::get('/characters', 'HomeController@characters')->name('characters');

    Route::get('/account/add', 'Auth\\EveSSOController@login')->name('sso.login');
    Route::get('/eve/callback', 'Auth\\EveSSOController@handle_callback')->name('sso.callback');

});
