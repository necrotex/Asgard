<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;


class Location extends CharacterUpdateJob
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

        $locationResponse = $api->characters($this->character->id)->location()->get();
        $shipResponse = $api->characters($this->character->id)->ship()->get();

        Character\Location::updateOrCreate(
            [
                'character_id' => $this->character->id,
            ],
            [
                'ship_type_id' => $shipResponse->get('ship_type_id'),
                'ship_name' => $shipResponse->get('ship_name'),
                'solar_system_id' => $locationResponse->get('solar_system_id'),
            ]
        );

    }
}
