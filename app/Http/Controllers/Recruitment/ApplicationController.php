<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\Application;
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
        $applications = Application::where('active', '=', true)->get();
        return DataTables::of($applications);
    }

    public function achivedApplications()
    {
        $applications = Application::where('active', '=', false)->get();
        return DataTables::of($applications);
    }


    public function show(Application $application)
    {
        return view('dashboard.recruitment.application', compact('application'));
    }
}
