<?php

namespace Asgard\Jobs\Update;

use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VerifyTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;

    public $character;

    /**
     * Create a new job instance.
     *
     * @param Character $character
     */
    public function __construct(\Asgard\Models\Character $character)
    {
        $this->character = $character;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $httpClient = new Client();
        $payload = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->character->refresh_token
        ];

        $httpClient->request('POST', 'https://login.eveonline.com/oauth/token',
            [
                'auth' => [config('services.eveonline.client_id'), config('services.eveonline.client_secret')],
                'form_params' => $payload
            ]
        );
    }

    public function failed($exception = null)
    {
        // don't do anything if the api is fucked and returns a server error
        if ($exception->getCode() >= 500) {
            return;
        }

        $this->character->active = false;
        $this->character->save();

        activity('error')
            ->performedOn($this->character)
            ->withProperty('exception', $exception->getMessage())
            ->log('Access token verification failed');
    }
}
