<?php

namespace Asgard\Http\Controllers\Recruitment;

use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('dashboard.recruitment.applications');
    }
}
