<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Discord\FetchRoles;
use Asgard\Jobs\Eve\Assets;

use Asgard\Jobs\Eve\Character\Location;
use Asgard\Jobs\Eve\Character\Mails;
use Asgard\Jobs\Eve\Character\Status;
use Asgard\Jobs\Eve\Journal;
use Asgard\Jobs\Eve\Transactions;
use Asgard\Jobs\Eve\Wallet;
use Asgard\Jobs\Update\InitialCharacterSetup;
use Asgard\Models\Character;
use Asgard\Models\SystemMessage;


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
        if (auth()->user()->can('view-application')) {
            $messages = SystemMessage::limit(15)->latest()->get();
        } else {
            $messages = []; // todo: write query for normal users
        }

        return view('dashboard.home', compact('messages'));
    }

    public function debug()
    {
        $char = Character::find(95149868);
        //dd($char->status->online);

        dispatch_now(new FetchRoles());
    }
}
