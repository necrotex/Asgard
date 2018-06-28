<?php

namespace Asgard\Http\Controllers\Service;

use Asgard\Jobs\Discord\Rename;
use Asgard\Jobs\Discord\UpdateUserRolesJob;
use Asgard\Models\DiscordUser;
use Asgard\Models\User;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discordUser = Auth::user()->discordAccount;

        return view('dashboard.discord', ['account' => $discordUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Socialite::with('discord')->redirect();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Socialite::driver('discord')->user();

        $discordUser = DiscordUser::firstOrNew(['id' => $user->id]);
        $discordUser->nickname = $user->nickname;
        $discordUser->avatar_url = $user->avatar;
        $discordUser->refresh_token = $user->refreshToken;

        Auth::user()->discordAccount()->save($discordUser);

        $this->dispatch(new Rename(Auth::user()));
        $this->dispatch(new UpdateUserRolesJob(Auth::user()));

        return redirect()->route('profile.show', auth()->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param User $user
     * @return Redirect
     */
    public function destroy(User $user)
    {
        $user->discordAccount()->delete();

        return back();
    }
}
