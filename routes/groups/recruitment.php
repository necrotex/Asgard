<?php

Route::group(['prefix' => 'recruitment', 'namespace' => 'Recruitment'], function () {

    //Forms
    Route::get('/forms', 'FormController@index')
        ->name('forms.index')
        ->middleware('can:create,Asgard/Models/ApplicationForm');

    Route::get('/forms/create', 'FormController@create')
        ->name('forms.create')
        ->middleware('can:create,Asgard/Models/ApplicationForm');

    Route::get('/forms/{form}', 'FormController@show')
        ->name('forms.show')
        ->middleware('can:view,form');

    Route::get('/forms/{form}/edit', 'FormController@edit')
        ->name('forms.edit')
        ->middleware('can:update,form');

    Route::post('/forms/store', 'FormController@store')
        ->name('forms.store')
        ->middleware('can:create,Asgard/Models/ApplicationForm');

    Route::post('/forms/{form}/update', 'FormController@update')
        ->name('forms.update')
        ->middleware('can:update,form');


    Route::post('/forms/{form}/question/store', 'QuestionController@store')
        ->name('question.store')
        ->middleware('can:create,Asgard/Models/ApplicationFormQuestion');

    Route::get('/forms/question/{question}', 'QuestionController@edit')
        ->name('question.edit')
        ->middleware('can:update,Asgard/Models/ApplicationFormQuestion');

    Route::post('/forms/question/{question}/update', 'QuestionController@update')
        ->name('question.update')
        ->middleware('can:update,Asgard/Models/ApplicationFormQuestion');

    //Applications
    Route::get('/applications', 'ApplicationController@index')
        ->name('applications.index')
        ->middleware('ability:create-application-invite');

    Route::get('/applications/invite/forms', 'InviteController@forms')
        ->name('applications.invite.forms')
        ->middleware('ability:create-application-invite');

    Route::post('/applications/invite/code', 'InviteController@inviteCode')
        ->name('applications.invite.code')
        ->middleware('ability:create-application-invite');


    // Apply
    Route::get('/apply', 'ApplicationFormController@index')
        ->name('applications.index')
        ->middleware('ability:create-application');

    Route::post('/apply', 'ApplicationFormController@create')
        ->name('applications.create')
        ->middleware('ability:create-application');


});