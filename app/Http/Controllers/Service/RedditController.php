<?php

namespace Asgard\Http\Controllers\Service;

use Asgard\Jobs\Reddit\AddApprovedSubmitterJob;
use Asgard\Models\RedditUser;
use Asgard\Models\Setting;
use Asgard\Models\User;
use Asgard\Support\Reddit;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class RedditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = Auth::user()->redditAccount;

        return view('dashboard.reddit', ['account' => $account]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Socialite::with('reddit')->redirect();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Socialite::driver('reddit')->user();

        if($request->session()->pull('reddit_mod_account') == true) {
            Setting::set('reddit.modaccount.name', $user->nickname);
            Setting::set('reddit.modaccount.id', $user->id);
            Setting::set('reddit.modaccount.refresh_token', $user->refreshToken);

            return redirect()->route('settings.index');
        }

        $redditUser = RedditUser::firstOrNew(['reddit_id' => $user->id]);
        $redditUser->nickname = $user->nickname;

        Auth::user()->redditAccount()->save($redditUser);

        //$this->dispatch(new AddApprovedSubmitterJob($redditUser));


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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->redditAccount->delete();

        return back();
    }

    public function runner()
    {
        $reddit = new Reddit();

        $user = RedditUser::first();
        $reddit->removeContributor($user);

        dd($reddit->getSubredditContributors());
    }

    public function moderatorAccountRedirect(Request $request)
    {
        $request->session()->put('reddit_mod_account', true);

        return Socialite::driver('reddit')
            ->scopes(['read', 'modconfig', 'modcontributors'])
            ->with(['duration' => 'permanent'])
            ->redirect();
    }
}
