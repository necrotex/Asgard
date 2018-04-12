<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;


class Wallet extends CharacterUpdateJob
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
        $return = $api->characters($this->character->id)->wallet()->get();

        Character\Wallet::create(['character_id' => $this->character->id, 'amount' => $return->data]);
    }
}
