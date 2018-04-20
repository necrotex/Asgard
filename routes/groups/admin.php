<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'finished-account'], function() {

    Route::get('/corporation', 'CorporationController@index')
        ->name('corporation.index')
        ->middleware('ability:see-corporation');


    Route::post('/corporation/add', 'CorporationController@store')
        ->name('corporation.store')
        ->middleware('ability:create-corporation');


    Route::get('/corporation/{id}', 'CorporationController@show')
        ->name('corporation.show')
        ->middleware('ability:see-corporation');


    Route::post('/corporation/{corp}/update', 'CorporationController@update')
        ->name('corporation.update')
        ->middleware('ability:update-corporation');


    //roles
    Route::get('/roles', 'RoleController@index')
        ->name('roles.index')
        ->middleware('ability:see-roles');


    Route::get('/roles/create', 'RoleController@create')
        ->name('roles.create')
        ->middleware('ability:create-roles');

    Route::post('/roles/store', 'RoleController@store')
        ->name('roles.store')
        ->middleware('ability:create-roles');

    Route::get('/roles/{role}/edit', 'RoleController@edit')
        ->name('roles.edit')
        ->middleware('ability:update-corporation');

    Route::post('/roles/{role}/update', 'RoleController@update')
        ->name('roles.update')
        ->middleware('ability:update-roles');

    Route::get('/roles/{role}/destroy', 'RoleController@destroy')
        ->name('roles.destroy')
        ->middleware('ability:delete-roles');

    //abilities
    Route::get('/abilities/{ability}/destroy', 'AbilityController@destroy')
        ->name('ability.destroy')
        ->middleware('ability:delete-roles');

    Route::post('/abilities/assign/{role}', 'RoleController@destroy')
        ->name('ability.assign')
        ->middleware('ability:delete-roles');


    //settings
    Route::get('/settings', 'SettingsController@index')
        ->name('settings.index')
        ->middleware('ability:manage-settings');
});