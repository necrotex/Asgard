<?php

namespace Asgard\Http\Controllers\Auth;

use Asgard\Models\Character;
use Asgard\Models\Token;
use Asgard\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use nullx27\Socialite\EveOnline\Traits\EveAuth;

use Asgard\Jobs\Eve\Character\Assets;
use Asgard\Jobs\Eve\Character\Contacts;
use Asgard\Jobs\Eve\Character\CorporationHistory;
use Asgard\Jobs\Eve\Character\CorporationRoles;
use Asgard\Jobs\Eve\Character\Fatigue;
use Asgard\Jobs\Eve\Character\Journal;
use Asgard\Jobs\Eve\Character\Location;
use Asgard\Jobs\Eve\Character\Mails;
use Asgard\Jobs\Eve\Character\Skillqueue;
use Asgard\Jobs\Eve\Character\Skills;
use Asgard\Jobs\Eve\Character\Status;
use Asgard\Jobs\Eve\Character\Titles;
use Asgard\Jobs\Eve\Character\Transactions;
use Asgard\Jobs\Eve\Character\Wallet;

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

                Auth::user()->characters()->save($character);

                $this->initalCharacterImport($character);
            }

            if ($type == 'site_login') {
                $name = str_slug($this->user->name);

                // check if the character is already assigned to an account
                $character = Character::find($this->user->id);

                if (is_null($character)) {
                    $request->session()->put('new_account', true);
                    $user = User::firstOrCreate(['name' => $name]);
                } else {
                    $user = $character->user;
                }

                //@todo: add whitelist maybe
                Auth::login($user, true);
            }

        } // ignore model not found exceptions
        catch (ModelNotFoundException $e) {
        } catch (Exception $exception) {
            dd($exception);
        } finally {
            // always redirect
            return redirect()->intended('/');
        }
    }

    private function initalCharacterImport(Character $character)
    {
        \Asgard\Jobs\Update\Character::dispatch($character)->allOnQueue('high');
        Location::dispatch($character)->allOnQueue('high');
        Status::dispatch($character)->allOnQueue('high');
        Skills::dispatch($character)->allOnQueue('high');
        Skillqueue::dispatch($character)->allOnQueue('high');
        CorporationHistory::dispatch($character)->allOnQueue('high');
        Fatigue::dispatch($character)->allOnQueue('high');
        CorporationRoles::dispatch($character)->allOnQueue('high');
        Titles::dispatch($character)->allOnQueue('high');
        Contacts::dispatch($character)->allOnQueue('high');
        Assets::dispatch($character)->allOnQueue('high');
        Mails::dispatch($character)->allOnQueue('high');
        Wallet::dispatch($character)->allOnQueue('high');
        Journal::dispatch($character)->allOnQueue('high');
        Transactions::dispatch($character)->allOnQueue('high');

    }

}
