<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Http\Controllers\Controller;
use Asgard\Models\Application;
use Asgard\Models\ApplicationComment;
use Asgard\Models\ApplicationStatus;
use Asgard\Notifications\Recruitment\NewStatus;
use Illuminate\Http\Request;

class ApplicationStatusController extends Controller
{
    public function update(Request $request, Application $application)
    {
        /*@todo : look at this and think about if it makes sense
        if(!$application->active) {
            abort('403', 'Application is closed.');
        }*/

        $status = ApplicationStatus::findOrFail($request->input('application_status'));

        if($status->slug == 'accepted' || $status->slug == 'denied') {
            $application->active = false;

            \Bouncer::retract('recruit')->from($application->applicant);
        }

        $application->status_id = $status->id;
        $application->save();

        activity('recruitment')->causedBy(auth()->user())->performedOn($application)->log('New Status: ' . $status->title);

        ApplicationComment::create(
            [
                'application_id' => $application->id,
                'system_message' => true,
                'user_id' => auth()->user()->id,
                'comment' => 'New Status: ' . $status->title,
            ]
        );

        if($status->slug == 'accepted') {
            $application->applicant();

        }

        $application->notify(new NewStatus($application, $status, auth()->user()));

        return back();
    }
}
