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
    protected $scopes = [];


    public function __construct()
    {
        $this->scopes = explode(',', config('services.eveonline.scopes'));
    }

    public function login()
    {
        return Socialite::driver('eveonline')
            ->scopes($this->scopes)
            ->redirect();
    }

    public function handle_callback()
    {
        $this->callback();
        $character_data = $this->get_character();

        $character = Character::firstOrNew(['id' => $this->user->id]);
        $character->refresh_token = $this->user->refreshToken;
        $character->name = $this->user->name;
        $character->owner_hash = $this->user->owner_hash;

        Auth::user()->characters()->save($character);

        if(empty($character->token())) {
            $character->token()->create([
                'token' => $this->user->token,
                'expiry' => $this->user->user['ExpiresOn']
            ]);
        }


        return redirect()->route('home');
    }

}
