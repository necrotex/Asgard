<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Eve\CorporationHistory;


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

    public function debug()
    {
        $this->dispatch(new CorporationHistory(auth()->user()->mainCharacter));

        foreach(auth()->user()->mainCharacter->corporationHistory as $history)
        {
            print $history->corporation_id . PHP_EOL;
        }
    }
}
