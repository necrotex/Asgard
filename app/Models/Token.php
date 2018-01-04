<?php

namespace Asgard\Models;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['token', 'expiry'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function renew()
    {
        $httpClient = new Client();

        $payload = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->character->refresh_token
        ];

        $response = $httpClient->request('POST', 'https://login.eveonline.com/oauth/token',
            [
                'auth' => [config('services.eveonline.client_id'), config('services.eveonline.client_secret')],
                'form_params' => $payload
            ]
        );

        $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

        $this->token = $data->access_token;
        $this->expiry = Carbon::now()->addSeconds($data->expires_in);
        $this->save();

        return $this;
    }
}
