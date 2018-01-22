<?php

namespace Asgard\Http\Controllers\Character;

use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.profile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'mainCharacter' => 'integer|required'
        ]);

        Auth::user()->main_character = $request->input('mainCharacter');
        Auth::user()->save();

        return back();
    }

}
