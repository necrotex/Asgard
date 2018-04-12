<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Jobs\Eve\Character\CharacterUpdateJob;
use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;

class CorporationRoles extends CharacterUpdateJob
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
        $response = $api->characters($this->character->id)->roles()->get();
        $roles = $this->character->corporationRoles;

        foreach ($roles as $role) {
            if (!in_array($role->role, $response->roles)) {
                $role->delete();
            }
        }

        foreach ($response->roles as $role) {
            Character\CorporationRole::firstOrCreate(
                [
                    'character_id' => $this->character->id,
                    'role' => $role
                ]
            );
        }
    }
}
