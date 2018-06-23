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

        if (count(auth()->user()->characters) == 0) {
            flash('Please add your characters to the system before you apply.')->warning();

            return redirect()->route('characters.index');
        }

        if (!auth()->user()->mainCharacter) {
            flash('Please select your main character before you apply.')->warning();

            return redirect()->route('profile.show', auth()->user());
        }

        $userInvite = auth()->user()->invites()->where('completed', false)->firstOrFail();

        $form = ApplicationForm::find($userInvite->invite->application_form_id);

        return view('dashboard.recruitment.application-form', compact('form'));
    }


    public function store(Request $request)
    {

        $userInvite = auth()->user()->invites()->where('completed', false)->firstOrFail();

        $application = Application::create(
            [
                'user_id' => auth()->user()->id,
            ]
        );

        foreach ($request->all() as $question => $answer) {
            if ($question == '_token') {
                continue;
            }

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
        $userInvite->application_id = $application->id;
        $userInvite->save();

        activity('recruitment')->performedOn($application)->causedBy(auth()->user())->log('New Application');

        return redirect()->route('applications.show', $application);
    }

}
