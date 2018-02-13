<?php

namespace Asgard\Http\Controllers\User;

use Asgard\Models\Character;
use Asgard\Models\User;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Auth::user()->characters;

        return view('dashboard.characters')->with('characters', $characters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Character $character
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Character $character)
    {
        //dd($character->location->solarSystem->solarSystemName);

        return view('dashboard.character', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Character $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        $character->active = false;
        $character->save();

        return redirect()->route('characters.index');
    }
}
