<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\Application;
use Asgard\Models\ApplicationForm;
use Asgard\Models\ApplicationFormQuestion;
use Asgard\Models\ApplicationFormQuestionAnswer;
use Asgard\Models\UserInvitation;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class ApplicationFormController extends Controller
{
    public function create()
    {

        $userInvite = auth()->user()->invites()->where('completed', false)->first();

        $form = ApplicationForm::find($userInvite->invite->application_form_id);

        return view('dashboard.recruitment.application-form', compact('form'));
    }


    public function store(Request $request)
    {

        $userInvite = auth()->user()->invites()->where('completed', false)->first();

        $form = ApplicationForm::find($userInvite->invite->application_form_id);

        $application = Application::create(
            [
                'user_id' => auth()->user()->id,
            ]
        );

        foreach ($request->all() as $question => $answer) {
            if ($question == '_token') continue;

            $question_id = str_replace('question-', '', $question);
            $questionModel = ApplicationFormQuestion::find($question_id);

            ApplicationFormQuestionAnswer::create(
                [
                    'application_id' => $application->id,
                    'question_id' => $questionModel->order,
                    'question' => $questionModel->question,
                    'answer' => $answer,
                    'version' => 1,
                ]
            );
        }

        $userInvite->completed = true;

        return redirect()->route('applications.show', $application);
    }

}
