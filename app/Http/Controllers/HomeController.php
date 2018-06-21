<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Discord\FetchRoles;
use Asgard\Models\Character;
use Spatie\Activitylog\Models\Activity;


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

        //todo: filter this according to acl
        $messages = Activity::limit(15)->latest()->get();

        return view('dashboard.home', compact('messages'));
    }

    public function debug()
    {
        $char = Character::find(95149868);
        //dd($char->status->online);

        dispatch_now(new FetchRoles());
    }
}
