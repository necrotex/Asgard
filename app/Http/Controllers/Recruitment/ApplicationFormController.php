<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\ApplicationForm;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class ApplicationFormController extends Controller
{
    public function create() {
        $form = ApplicationForm::find(1); //@todo: use the actual form

        return view('dashboard.recruitment.application-form', compact('form'));
    }
}
