<?php

Route::group(['prefix' => 'user', 'namespace' => 'Character', 'middleware' => 'finished-account'], function() {
    Route::any('characters/{character}/mails', 'MailController@mails')->name('character.mails');
    Route::post('characters/{character}/mails', 'MailController@mail')->name('character.mail');

    Route::any('characters/{character}/journal', 'JournalController@entries')->name('character.journal');
    Route::any('characters/{character}/transactions', 'TransactionsController@entries')->name('character.transactions');

});