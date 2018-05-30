<?php

namespace Asgard\Http\Controllers\Recruitment;

use Asgard\Models\Application;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('dashboard.recruitment.applications');
    }


    public function show(Application $application)
    {

        return view('dashboard.recruitment.application', compact($application));
    }
}
