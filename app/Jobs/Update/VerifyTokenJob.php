<?php

namespace Asgard\Jobs\Update;

use Asgard\Support\ConduitAuthTrait;
use Asgard\Support\SendsSystemMessage;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VerifyTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait, SendsSystemMessage;

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
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        $api->setAuthentication($this->getAuthentication($this->character));

        // just make the call to verify the token, failed() will handle the rest
        $api->verify()->get();
    }

    public function failed($exception = null)
    {
        // don't do anything if the api is fucked and returns a server error
        if($exception->getCode() >= 500) {
            return;
        }

        $this->character->active = false;
        $this->character->save();

        $this->notifySystem('error', 'Character Authentification failed for ' . $this->character->name,
            $exception->getMessage(), 'token', 'character', $this->character->id);
    }
}
