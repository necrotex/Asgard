<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;

class Contacts extends CharacterUpdateJob
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

        $response = $api->characters($this->character->id)->contacts()->get();
        $contacts = collect($response->data)->recursive()->keyBy('contact_id');

        //filter out factions, no body cares about them anyway
        $contacts = $contacts->reject(function ($contact) {
            return $contact->get('contact_type') == 'faction';
        });

        $ids = $contacts->pluck('contact_id')->unique()->values();

        if($ids->isEmpty()) {
            return;
        }

        $response = $api->universe()->names()->data($ids->toArray())->post();
        $resolvedIds = collect($response->data)->recursive()->keyBy('id');

        $data = collect();
        $contacts->each(function ($contact, $id) use ($data, $resolvedIds) {
            $item = [
                'contact_id' => $id,
                'contact_type' => $resolvedIds->get($id)->get('category'),
                'standing' => $contact->get('standing'),
                'name' => $resolvedIds->get($id)->get('name'),
                'label' => null // @todo: this needs to be reworked!
            ];

            $data->push($item);
        });

        // remove all contacts before adding the new ones
        $this->character->contacts()->delete();
        $this->character->contacts()->createMany($data->toArray());
    }
}
