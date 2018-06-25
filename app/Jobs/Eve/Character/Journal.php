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

        $journals = collect($result->data)->recursive()->keyBy('id');
        $existingJournals = Character\Journal::whereIn('ref_id', $journals->keys())->get()->keyBy('ref_id');

        $journals = $journals->diffKeys($existingJournals);

        if ($journals->isEmpty()) {
            return;
        }

        $firstPartyIds = $journals->pluck('first_party_id');
        $secondPartyIds = $journals->pluck('second_party_id');

        $partyIds = $firstPartyIds->merge($secondPartyIds)->unique()->reject(function ($id) {
            return is_null($id);
        })->values()->push(500001);

        $partyIds->filter(function ($id, $key) use ($partyIds) {
            if ($id >= 500000 && $id < 1000000) {
                $partyIds->forget($key);
                return true;
            }
        });

        $resoledIdsRaw = $api->universe()->names()->data($partyIds->toArray())->post();
        $resolvedIds = collect($resoledIdsRaw->data)->recursive()->keyBy('id');

        $insert = collect();
        $journals->each(function ($journal) use ($resolvedIds, $insert) {

            $i = collect([
                'date' => Carbon::parse($journal->get('date')),
                'ref_id' => $journal->get('id', null),
                'ref_type' => $journal->get('ref_type', null),
                'context_id' => $journal->get('context_id', null),
                'context_type' => $journal->get('context_id_type', null),
                'description' => $journal->get('description', null),
                'first_party_id' => $journal->get('first_party_id', null),
                'second_party_id' => $journal->get('second_party_id', null),
                'amount' => $journal->get('amount', null),
                'balance' => $journal->get('balance', null),
                'reason' => $journal->get('reason', null),
                'tax_receiver_id' => $journal->get('tax_receiver_id', null),
                'tax' => $journal->get('tax', null),
            ]);

            if (!is_null($i->get('first_party_id'))) {
                $id = $i->get('first_party_id');

                if ($id >= 500000 && $id < 1000000) {
                    $i->put('first_party_type', 'faction');
                } else if ($resolvedIds->has($id)) {
                    $i->put('first_party_type', $resolvedIds->get($id)->get('category'));
                }
            }

            if (!is_null($i->get('second_party_id'))) {
                $id = $i->get('second_party_id');
                if ($id >= 500000 && $id < 1000000) {
                    $i->put('second_party_id', 'faction');
                } else if ($resolvedIds->has($id)) {
                    $i->put('second_party_type', $resolvedIds->get($id)->get('category'));
                }
            }

            $insert->push($i);
        });

        $this->character->journal()->createMany($insert->toArray());
    }
}
