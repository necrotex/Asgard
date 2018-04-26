<?php

Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {

    Route::get('/characters', 'CharacterController@index')
        ->name('characters.index')
        ->middleware('can:create,Asgard\Models\Character');

    Route::get('/characters/{character}', 'CharacterController@show')
        ->name('characters.show')
        ->middleware('can:view,character');

    Route::post('/characters/{character}/remove', 'CharacterController@destroy')
        ->name('characters.destroy')
        ->middleware('can:delete,character');

    Route::get('{user}/profile', 'ProfileController@show')
        ->name('profile.show')
        ->middleware(['can:view,user']);

    Route::post('{user}/profile/update', 'ProfileController@update')
        ->name('profile.update')
        ->middleware('can:update,user');
});