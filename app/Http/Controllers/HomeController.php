<?php

namespace Asgard\Http\Controllers;

use Asgard\Models\Character;
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

    public function landing()
    {

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

    public function characters()
    {
        $characters = Auth::user()->characters;

        return view('dashboard.characters')->with('characters', $characters);
    }

    public function debug()
    {
        $token = Character::first()->token;


        $api = new Easi($token->token);
    }
}
