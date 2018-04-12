<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;

/**
 * @property  character
 */
class Skillqueue extends CharacterUpdateJob
{
    use ConduitAuthTrait;

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     * @throws \Exception
     */
    public function handle(Conduit $api)
    {
        $api->setAuthentication($this->getAuthentication($this->character));
        $response = $api->characters($this->character->id)->skillqueue()->get();

        //completely remove skillqueue for the character for each update
        Character\Skillqueue::where('character_id', '=', $this->character->id)->delete();

        $data = [];
        foreach($response->data as $entry) {
            $item = get_object_vars($entry);
            $item['character_id'] = $this->character->id;

            if(array_key_exists('start_date', $item)) {
                $item['start_date'] = Carbon::parse($item['start_date']);
            }

            if(array_key_exists('finish_date', $item)) {
                $item['finish_date'] = Carbon::parse($item['finish_date']);
            }

            $data[] = $item;
        }

        Character\Skillqueue::insert($data);
    }
}
