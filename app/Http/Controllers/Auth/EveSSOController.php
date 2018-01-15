<?php

namespace Asgard\Http\Controllers\Auth;

use Asgard\Models\Character;
use Asgard\Models\Token;
use Exception;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use nullx27\Socialite\EveOnline\Traits\EveAuth;

class EveSSOController extends Controller
{
    use EveAuth;

    public function login(Request $request)
    {
        $scopes = explode(',', config('services.eveonline.scopes'));

        return Socialite::driver('eveonline')
            ->scopes($scopes)
            ->redirect();
    }

    public function handle_callback(Request $request)
    {
        $this->user = Socialite::driver('eveonline')->user();

        $character_data = $this->get_character();

        $character = Character::firstOrNew(['id' => $this->user->id]);
        $character->refresh_token = $this->user->refreshToken;
        $character->name = $this->user->name;
        $character->owner_hash = $this->user->owner_hash;
        $character->corporation_id = $character_data->corporation_id;

        Auth::user()->characters()->save($character);

        return redirect()->route('home');
    }

}
