<?php

Route::group(['prefix' => 'recruitment', 'namespace' => 'Recruitment', 'middleware' => 'finished-account'], function() {
    //Forms
    Route::get('/forms', 'FormController@index')->name('forms.index');
    Route::get('/forms/create', 'FormController@create')->name('forms.create');
    Route::get('/forms/{form}', 'FormController@show')->name('forms.show');
    Route::get('/forms/{form}/edit', 'FormController@edit')->name('forms.edit');

    Route::post('/forms/store', 'FormController@store')->name('forms.store');
    Route::post('/forms/{form}/update', 'FormController@update')->name('forms.update');
    Route::post('/forms/{form}/question/store', 'QuestionController@store')->name('question.store');
    Route::get('/forms/question/{question}', 'QuestionController@edit')->name('question.edit');
    Route::post('/forms/question/{question}/update', 'QuestionController@update')->name('question.update');

    //Applications
    Route::get('/applications', 'ApplicationController@index')->name('applications.index');

    Route::get('/applications/invite/forms', 'InviteController@forms')->name('applications.invite.forms');
    Route::post('/applications/invite/code', 'InviteController@inviteCode')->name('applications.invite.code');

    Route::get('/apply', 'ApplicationFormController@create')->name('applications.create');

});