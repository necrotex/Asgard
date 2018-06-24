<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\Application;
use Asgard\Models\ApplicationComment;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class ApplicationCommentController extends Controller
{
    public function store(Request $request, Application $application)
    {
        ApplicationComment::create(
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

        return back();
    }
}
