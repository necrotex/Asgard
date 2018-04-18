<?php

Route::group(['prefix' => 'timerboard', 'namespace' => 'Timerboard', 'middleware' => 'finished-account'], function() {
    Route::get('/index', 'TimerboardController@index')->name('timerboard.index');
    Route::get('/timer/{id}', 'TimerboardController@show')->name('timerboard.show');

    Route::post('/timer/edit/{id}', 'TimerboardController@edit')->name('timerboard.edit');
    Route::get('/timer/delete/{id}', 'TimerboardController@delete')->name('timerboard.delete');

    Route::post('/new', 'TimerboardController@new')->name('timerboard.new');

});