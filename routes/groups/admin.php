<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'finished-account'], function() {

    Route::get('/corporation', 'CorporationController@index')
        ->name('corporation.index')
        ->middleware('authorized:see-corporation');


    Route::post('/corporation/add', 'CorporationController@store')
        ->name('corporation.store')
        ->middleware('authorized:create-corporation');


    Route::get('/corporation/{id}', 'CorporationController@show')
        ->name('corporation.show')
        ->middleware('authorized:see-corporation');


    Route::post('/corporation/{corp}/update', 'CorporationController@update')
        ->name('corporation.update')
        ->middleware('authorized:update-corporation');


    //roles
    Route::get('/roles', 'RoleController@index')
        ->name('roles.index')
        ->middleware('authorized:see-roles');


    Route::get('/roles/create', 'RoleController@create')
        ->name('roles.create')
        ->middleware('authorized:create-roles');

    Route::post('/roles/store', 'RoleController@store')
        ->name('roles.store')
        ->middleware('authorized:create-roles');

    Route::get('/roles/{role}/edit', 'RoleController@edit')
        ->name('roles.edit')
        ->middleware('authorized:update-corporation');

    Route::post('/roles/{role}/update', 'RoleController@update')
        ->name('roles.update')
        ->middleware('authorized:update-roles');

    Route::get('/roles/{role}/destroy', 'RoleController@destroy')
        ->name('roles.destroy')
        ->middleware('authorized:delete-roles');

    //abilities
    Route::get('/abilities/{ability}/destroy', 'AbilityController@destroy')
        ->name('ability.destroy')
        ->middleware('authorized:delete-roles');

    Route::post('/abilities/assign/{role}', 'RoleController@destroy')
        ->name('ability.assign')
        ->middleware('authorized:delete-roles');


    //settings
    Route::get('/settings', 'SettingsController@index')
        ->name('settings.index')
        ->middleware('authorized:manage-settings');
});