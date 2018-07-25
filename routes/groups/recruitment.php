<?php

Route::group(['prefix' => 'recruitment', 'namespace' => 'Recruitment'], function () {

    //Forms
    Route::get('/forms', 'FormController@index')
        ->name('forms.index')
        ->middleware('can:create,' . \Asgard\Models\ApplicationForm::class);

    Route::get('/forms/create', 'FormController@create')
        ->name('forms.create')
        ->middleware('can:create,' . \Asgard\Models\ApplicationForm::class);

    Route::get('/forms/{form}', 'FormController@show')
        ->name('forms.show')
        ->middleware('can:view,form');

    Route::get('/forms/{form}/edit', 'FormController@edit')
        ->name('forms.edit')
        ->middleware('can:update,form');

    Route::post('/forms/store', 'FormController@store')
        ->name('forms.store')
        ->middleware('can:create,' . \Asgard\Models\ApplicationForm::class);

    Route::post('/forms/{form}/update', 'FormController@update')
        ->name('forms.update')
        ->middleware('can:update,form');


    Route::post('/forms/{form}/question/store', 'QuestionController@store')
        ->name('question.store')
        ->middleware('can:create,' . \Asgard\Models\ApplicationFormQuestion::class);

    Route::get('/forms/question/{question}', 'QuestionController@edit')
        ->name('question.edit')
        ->middleware('can:update,question');

    Route::post('/forms/question/{question}/update', 'QuestionController@update')
        ->name('question.update')
        ->middleware('can:update,question');

    //Applications
    Route::get('/applications', 'ApplicationController@index')
        ->name('applications.index')
        ->middleware('ability:create-application-invite');

    Route::any('/applications/active', 'ApplicationController@activeApplications')
        ->name('applications.active')
        ->middleware('ability:create-application-invite');

    Route::any('/applications/archive', 'ApplicationController@achivedApplications')
        ->name('applications.archive')
        ->middleware('ability:create-application-invite');

    Route::get('/applications/invite/forms', 'InviteController@forms')
        ->name('applications.invite.forms')
        ->middleware('ability:create-application-invite');

    Route::post('/applications/invite/code', 'InviteController@inviteCode')
        ->name('applications.invite.code')
        ->middleware('ability:create-application-invite');

    Route::get('/applications/{application}', 'ApplicationController@show')
        ->name('applications.show')
        ->middleware('can:view,application');

    Route::post('/applications/{application}/comment', 'ApplicationCommentController@store')
        ->name('applications.comment')
        ->middleware('can:create,' . \Asgard\Models\ApplicationComment::class);

    Route::post('/applications/{application}/status', 'ApplicationStatusController@update')
        ->name('applications.status')
        ->middleware('can:create,' . \Asgard\Models\ApplicationStatus::class);


    // Apply
    Route::get('/apply', 'ApplicationFormController@create')
        ->name('applications.create')
        ->middleware('can:create,' . \Asgard\Models\Application::class);

    Route::post('/apply', 'ApplicationFormController@store')
        ->name('applications.store')
        ->middleware('can:create,' . \Asgard\Models\Application::class);
});