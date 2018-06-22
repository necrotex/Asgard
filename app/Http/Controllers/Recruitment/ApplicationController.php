<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\Application;
use Asgard\Models\ApplicationStatus;
use Asgard\Models\Character;
use Asgard\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('dashboard.recruitment.applications');
    }

    public function activeApplications()
    {
        return $this->getApplicationsTable(true);
    }

    public function achivedApplications()
    {
        return $this->getApplicationsTable(false);
    }

    public function show(Application $application)
    {
        $application->load(['comments', 'questions', 'invite']);
        $statuses = ApplicationStatus::all();

        return view('dashboard.recruitment.application', compact('application', 'statuses'));
    }

    private function getApplicationsTable($active = true)
    {
        $applications = Application::with(['status', 'applicant'])->where('active', '=', $active)->get();

        return DataTables::of($applications)
            ->addColumn('name', function ($application) {
                return $application->applicant->mainCharacter->name;
            })
            ->addColumn('route', function ($application) {
                return route('applications.show', $application);
            })
            ->addColumn('status', function ($application) {
                return $application->status->title ?? 'New';
            })
            ->addColumn('last_update', function ($application) {
                return Carbon::parse($application->updated_at)->diffForHumans();
            })
            ->make(true);
    }
}
