<?php

Route::group(['prefix' => 'timerboard', 'namespace' => 'Timerboard'], function() {
    Route::get('/index', 'TimerboardController@index')
        ->name('timerboard.index')
        ->middleware('can:create,Asgard\Models\Timer');

    Route::get('/timer/{id}', 'TimerboardController@show')
        ->name('timerboard.show')
        ->middleware('can:view,id');

    Route::post('/timer/edit/{timer}', 'TimerboardController@edit')
        ->name('timerboard.edit')
        ->middleware('can:edit,timer');

    Route::get('/timer/delete/{timer}', 'TimerboardController@delete')
        ->name('timerboard.delete')
        ->middleware('can:delete,timer');

    Route::post('/new', 'TimerboardController@new')
        ->name('timerboard.new')
        ->middleware('can:create,Asgard\Models\Timer');
});