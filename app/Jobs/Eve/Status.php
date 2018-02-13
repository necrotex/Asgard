<?php

namespace Asgard\Jobs\Eve;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Status implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;

    public $character;

    /**
     * Create a new job instance.
     *
     * @param Character $character
     */
    public function __construct(Character $character)
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

        $response = $api->characters($this->character->id)->online()->get();

        Character\Status::updateorCreate(
            [
                'character_id' => $this->character->id
            ],
            [
                'online' => $response->get('online'),
                'last_login' => Carbon::parse($response->get('online')),
                'last_logout' => Carbon::parse($response->get('online')),
                'logins' => $response->get('logins'),
            ]
        );
    }
}
