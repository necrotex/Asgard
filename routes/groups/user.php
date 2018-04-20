<?php

Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {

    Route::get('/characters', 'CharacterController@index')
        ->name('characters.index')
        ->middleware('ability:add-characters');


    Route::get('/characters/{character}', 'CharacterController@show')
        ->name('characters.show')
        ->middleware('ability:add-characters');

    Route::post('/characters/{character}/remove', 'CharacterController@destroy')
        ->name('characters.destroy')
        ->middleware('ability:add-characters');

    Route::get('{user}/profile', 'ProfileController@show')
        ->name('profile.show')
        ->middleware('ability:add-characters');

    Route::post('{user}/profile/update', 'ProfileController@update')
        ->name('profile.update')
        ->middleware('ability:add-characters');
});