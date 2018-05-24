<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Jobs\Eve\Character\CharacterUpdateJob;
use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
use Log;

class Journal extends CharacterUpdateJob
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

        $result = $api->characters($this->character->id)->wallet()->journal()->get();

        foreach ($result->data as $entry) {

            if (is_null(data_get($entry, 'ref_id', null))) { //todo: debug this correctly
                Log::debug("Coundl't load journal entry");
                continue;
            }

            $extraInfo = data_get($entry, 'extra_info', null);

            $extraInfoCompiled = [];

            if (!is_null($extraInfo)) {
                foreach ($extraInfo as $k => $v) {
                    $extraInfoCompiled['extra_' . $k] = $v;
                }
            }

            $data = [
                'character_id' => $this->character->id,
                'date' => Carbon::parse(data_get($entry, 'date', null)),
                'ref_type' => data_get($entry, 'ref_type', null),
                'first_party_id' => data_get($entry, 'first_party_id', null),
                'first_party_type' => data_get($entry, 'first_party_type', null),
                'second_party_id' => data_get($entry, 'second_party_id', null),
                'second_party_type' => data_get($entry, 'second_party_type', null),
                'amount' => data_get($entry, 'amount', null),
                'balance' => data_get($entry, 'balance', null),
                'reason' => data_get($entry, 'reason', null),
                'tax_receiver_id' => data_get($entry, 'tax_receiver_id', null),
                'tax' => data_get($entry, 'tax', null)
            ];

            $data = array_merge($data, $extraInfoCompiled);

            Character\Journal::firstOrCreate(['ref_id' => data_get($entry, 'ref_id', null)], $data);
        }
    }
}
