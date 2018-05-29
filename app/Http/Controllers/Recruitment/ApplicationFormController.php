<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\ApplicationForm;
use Asgard\Models\UserInvitation;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class ApplicationFormController extends Controller
{
    public function index() {

        $userInvite = auth()->user()->invites()->where('completed', false)->first();

        $form = ApplicationForm::find($userInvite->invite->application_form_id);

        return view('dashboard.recruitment.application-form', compact('form'));
    }


    public function create(Request $request) {

        $userInvite = auth()->user()->invites()->where('completed', false)->first();
        $form = ApplicationForm::find($userInvite->invite->application_form_id);

        foreach($request->all())

    }

}
