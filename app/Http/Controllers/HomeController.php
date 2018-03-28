<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Eve\Assets;

use Asgard\Jobs\Eve\Journal;
use Asgard\Jobs\Eve\Transactions;
use Asgard\Jobs\Eve\Wallet;
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

        dd($char->wallet);
    }
}
