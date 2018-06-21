<?php

namespace Asgard\Http\Controllers\Auth;

use Asgard\Jobs\Update\InitialImportJob;
use Asgard\Models\ApplicationInvite;
use Asgard\Models\Character;
use Asgard\Models\User;
use Asgard\Models\UserInvitation;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use nullx27\Socialite\EveOnline\Traits\EveAuth;



class EveSSOController extends Controller
{
    use EveAuth;

    public function siteLogin(Request $request)
    {
        $request->session()->put('login_type', 'site_login');

        return Socialite::driver('eveonline')
            ->stateless()
            ->redirect();
    }

    public function login(Request $request)
    {
        $scopes = explode(',', config('services.eveonline.scopes'));

        $request->session()->put('login_type', 'add_character');

        return Socialite::driver('eveonline')
            ->stateless()
            ->scopes($scopes)
            ->redirect();
    }

    public function handle_callback(Request $request)
    {
        $redirectRoute = '/';

        try {
            $this->user = Socialite::driver('eveonline')->stateless()->user();
            $character_data = $this->get_character();

            $type = $request->session()->pull('login_type');

            if ($type == 'add_character') {
                $character = Character::firstOrNew(['id' => $this->user->id]);

                $character->refresh_token = $this->user->refreshToken;
                $character->name = $this->user->name;
                $character->owner_hash = $this->user->owner_hash;
                $character->corporation_id = $character_data->corporation_id;
                $character->active = true;

                Auth::user()->characters()->save($character);

                InitialImportJob::dispatch($character)->onQueue('high');

                $redirectRoute = route('characters.index');
                flash('Character successfully added! It can take up to a minute or two until the character sheet is accessible.')->success();

                // only notify the system if its a new character
                if($character->wasRecentlyCreated) {
                    activity('info')->performedOn(auth()->user())
                        ->causedBy($character)
                        ->log('Added new Character');
                } else {
                    activity('info')->performedOn(auth()->user())
                        ->causedBy($character)
                        ->log('Refreshed Character');
                }
            }

            if ($type == 'site_login') {

                $name = str_slug($this->user->name);

                // check if the character is already assigned to an account
                $character = Character::find($this->user->id);

                if (is_null($character)) {
                    if (config('asgard.open_registration') !== true) {
                        return abort(403, 'Please contact a recruiter for access.');
                    }

                    $request->session()->put('new_account', true);
                    $user = User::firstOrCreate(['name' => $name]);

                    if ($request->session()->has('recuritment_code')) {
                        $invite = $invite = ApplicationInvite::where('code', '=', $request->session()->pull('recuritment_code'))->first();

                        UserInvitation::create(['user_id' => $user->id, 'invite_id' => $invite->id]);

                        $user->assign('recruit');
                    }

                    if ($user->isNotA('recruit')) {
                        $user->assign('guest');
                    }

                    activity('info')->performedOn($user)->log('Account Created');

                } else {
                    $user = $character->user;
                }

                //@todo: add whitelist maybe
                Auth::login($user, true);
            }

        } // ignore model not found exceptions
        catch (ModelNotFoundException $e) {
        } catch (ClientException $e) {
            return abort(500, 'Something went wrong while talking to the CCP API. Please try again in a minute.');
        }
        //@todo: catch errors from eve sso and report it clearly to the user

        return redirect()->intended($redirectRoute);
    }
}
