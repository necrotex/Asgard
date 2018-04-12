<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;

class Status extends CharacterUpdateJob
{
    use ConduitAuthTrait;

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

        Character\Status::updateOrCreate(
            [
                'character_id' => $this->character->id
            ],
            [
                'online' => $response->get('online'),
                'last_login' => Carbon::parse($response->get('last_login')),
                'last_logout' => Carbon::parse($response->get('last_logout')),
                'logins' => $response->get('logins'),
            ]
        );
    }
}
