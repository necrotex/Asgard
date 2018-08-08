<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'finished-account'], function() {

    Route::get('/corporation', 'CorporationController@index')
        ->name('corporation.index')
        ->middleware('can:create,Asgard\Models\Corporation');


    Route::post('/corporation/add', 'CorporationController@store')
        ->name('corporation.store')
        ->middleware('can:create,Asgard\Models\Corporation');


    Route::get('/corporation/{corporation}', 'CorporationController@show')
        ->name('corporation.show')
        ->middleware('can:view,corporation');

    Route::any('/corporation/{corporation}/active-members', 'CorporationController@activeMembers')
        ->name('corporation.active-members')
        ->middleware('can:view,corporation');

    Route::any('/corporation/{corporation}/missing-members', 'CorporationController@missingMembers')
        ->name('corporation.missing-members')
        ->middleware('can:view,corporation');


    Route::post('/corporation/{corporation}/update', 'CorporationController@update')
        ->name('corporation.update')
        ->middleware('can:update,corporation');


    //search
    Route::post('/search', 'SearchController@search')
        ->name('search')
        ->middleware('ability:use-search');


    //roles
    Route::get('/roles', 'RoleController@index')
        ->name('roles.index')
        ->middleware('can:view,Silber\Bouncer\Database\Role');

    Route::get('/roles/create', 'RoleController@create')
        ->name('roles.create')
        ->middleware('can:create,Silber\Bouncer\Database\Role');

    Route::post('/roles/store', 'RoleController@store')
        ->name('roles.store')
        ->middleware('can:create,Silber\Bouncer\Database\Role');

    Route::get('/roles/{role}/edit', 'RoleController@edit')
        ->name('roles.edit')
        ->middleware('can:update,role');

    Route::post('/roles/{role}/update', 'RoleController@update')
        ->name('roles.update')
        ->middleware('can:update,role');

    Route::get('/roles/{role}/destroy', 'RoleController@destroy')
        ->name('roles.destroy')
        ->middleware('can:delete,role');


    //settings
    Route::get('/settings', 'SettingsController@index')
        ->name('settings.index')
        ->middleware('can:view,Asgard\Models\Setting');

    Route::post('/settings', 'SettingsController@update')
        ->name('settings.update')
        ->middleware('can:update,Asgard\Models\Setting');


    //Users Overview
    Route::any('/users/table', 'UsersController@table')
        ->name('users.table')
        ->middleware('ability:see-profiles');

    Route::get('/users', 'UsersController@overview')
        ->name('users.overview')
        ->middleware('ability:see-profiles');

    // Feedback

    Route::get('/feedback', '\Asgard\Http\Controllers\Service\FeedbackController@index')
        ->name('feedback.index')
        ->middleware('can:view,' . \Asgard\Models\Feedback::class);

    Route::get('/feedback/{feedback}', '\Asgard\Http\Controllers\Service\FeedbackController@show')
        ->name('feedback.show')
        ->middleware('can:view,feedback');
});