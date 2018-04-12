<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;


class Titles extends CharacterUpdateJob
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
        $response = $api->characters($this->character->id)->titles()->get();

        $titleIds = [];
        $titles = $this->character->titles;

        foreach ($response->data as $remoteTitle) {
            $titleIds[] = $remoteTitle->title_id;

            Character\Title::firstOrCreate(
                [
                    'character_id' => $this->character->id,
                    'title_id' => $remoteTitle->title_id
                ],
                [
                    'name' => $remoteTitle->name
                ]
            );
        }

        foreach ($titles as $title) {
            if (!in_array($title->title_id, $titleIds)) {
                $title->delete();
            }
        }
    }
}
