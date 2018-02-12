<?php

namespace Asgard\Http\Controllers;

use Asgard\Models\Character;
use Conduit\Conduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use nullx27\Easi\Easi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home');
    }
}
