<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Http\Controllers\Controller;
use Asgard\Models\Application;
use Asgard\Models\ApplicationComment;
use Asgard\Notifications\Recruitment\NewComment;
use Asgard\Notifications\RecruitmentAction;
use Illuminate\Http\Request;

class ApplicationCommentController extends Controller
{
    public function store(Request $request, Application $application)
    {
        $comment = ApplicationComment::create(
            [
                'application_id' => $application->id,
                'user_id' => auth()->user()->id,
                'comment' => $request->input('comment'),
            ]
        );

        $application->touch();

        activity('recruitment')
            ->performedOn($application)
            ->causedBy(auth()->user())
            ->log('New Comment');

        flash('Sucessfully commented')->success();

        $application->notify(new NewComment($comment));

        return back();
    }
}
