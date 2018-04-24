<?php

Route::group(['prefix' => 'user', 'namespace' => 'Character'], function() {

    Route::any('characters/{character}/mails', 'MailController@mails')
        ->name('character.mails'); //@todo: refactor to work with policies

    Route::post('characters/{character}/mails/{mail}', 'MailController@mail')
        ->name('character.mail'); //@todo: refactor to work with policies

    Route::any('characters/{character}/journal', 'JournalController@entries')
        ->name('character.journal'); //@todo: refactor to work with policies

    Route::any('characters/{character}/transactions', 'TransactionsController@entries')
        ->name('character.transactions'); //@todo: refactor to work with policies
});