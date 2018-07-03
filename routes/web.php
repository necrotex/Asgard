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


Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/login/sso', 'Auth\EveSSOController@siteLogin')->name('sso.site-login');
Route::get('/eve/callback', 'Auth\EveSSOController@handle_callback')->name('sso.callback');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/invite/{invite}', 'Recruitment\InviteController@setupApplication')
    ->name('applications.invite.landing');

Route::group(['middleware' => ['auth', 'finished-account']], function () {

    Route::get('/home', function() {
        return redirect('/');
    });

    Route::get('/', 'HomeController@index')->name('home')->middleware(['finished-account']);

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/account/add', 'EveSSOController@login')->name('sso.login');
    });

    // admin
    include_once 'groups/admin.php';

    // user
    include_once 'groups/user.php';

    // character
    include_once 'groups/character.php';

    // recruitment
    include_once 'groups/recruitment.php';

    // timerboard
    include_once 'groups/timerboard.php';

    // services
    include_once 'groups/services.php';

});


Route::get('/debug', 'HomeController@debug');