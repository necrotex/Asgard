<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Eve\Contacts;
use Asgard\Jobs\Eve\Status;
use Asgard\Jobs\Eve\Titles;
use Asgard\Models\Character;


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
        $char = Character::find(95149868);
        dispatch_now(new Contacts($char));

        dd($char->contacts);


    }
}
