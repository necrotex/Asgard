<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Jobs\Eve\Character\CharacterUpdateJob;
use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;

class CorporationHistory extends CharacterUpdateJob
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
        $response = $api->characters($this->character->id)->corporationhistory()->get();

        $corps = array_reverse($response->data);

        foreach($corps as $data) {

            $corp = $api->corporations($data->corporation_id)->get();

            Character\CorporationHistory::firstOrCreate(
                [
                    'record_id' => $data->record_id,
                    'character_id' => $this->character->id
                ],
                [
                    'corporation_id' => $data->corporation_id,
                    'corporation_name' => $corp->name,
                    'start_date' => Carbon::parse($data->start_date),
                ]
            );
        }
    }
}
