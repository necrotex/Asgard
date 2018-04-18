<?php

Route::group(['prefix' => 'services', 'namespace' => 'Service', 'middleware' => 'finished-account'], function() {
    Route::get('/discord', 'DiscordController@index')->name('services.discord.index');
    Route::get('/discord/redirect', 'DiscordController@create')->name('services.discord.redirect');
    Route::get('/discord/callback', 'DiscordController@store')->name('services.discord.callback');

    Route::get('/discord/{user}/unlink', 'DiscordController@destroy')->name('services.discord.unlink');

    Route::get('/reddit', 'RedditController@index')->name('services.reddit.index');
    Route::get('/reddit/{user}/destroy', 'RedditController@destroy')->name('services.reddit.destroy');
    Route::get('/reddit/redirect', 'RedditController@create')->name('services.reddit.redirect');
    Route::get('/reddit/callback', 'RedditController@store')->name('services.reddit.callback');

    Route::get('/reddit/debug', 'RedditController@runner')->name('services.reddit.runner');
    Route::get('/reddit/redirect/modaccount', 'RedditController@moderatorAccountRedirect')->name('services.reddit.redirect_modaccount');
});