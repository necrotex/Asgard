<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character\Asset;
use Asgard\Support\ConduitAuthTrait;
use Asgard\Support\EVEOnlineIDs;
use Conduit\Conduit;
use Illuminate\Support\Collection;
use Log;

class Assets extends CharacterUpdateJob
{

    use ConduitAuthTrait;

    /**
     * @var
     */
    private $locations;

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
        $response = $api->characters($this->character->id)->assets()->get();

        $pages = (int)$response->getHeader('X-Pages');
        $assets = collect($response->data)->recursive()->keyBy('item_id');

        if ($pages > 1) {
            for ($i = 2; $i <= $pages; $i++) {
                $response = $api->characters($this->character->id)->assets()->query(['page' => $i])->get();
                $assets = $assets->merge($response->data);
            }
        }

        $assets = $assets->recursive()->keyBy('item_id');

        // resolve station and solar system names
        $stationIds = $assets->where('location_type', 'station')->pluck('location_id')->unique()->values();
        $systemIds = $assets->where('location_type', 'solar_system')->pluck('location_id')->unique()->values();

        $ids = $stationIds->merge($systemIds)->unique()->values();

        if ($ids->isEmpty()) {
            return;
        }

        $response = $api->universe()->names()->data($ids->toArray())->post();
        $resolvedIds = collect($response->data)->recursive()->keyBy('id');

        // asset names
        $assetNames = collect();
        $assets->chunk(250)->each(function ($asset) use ($api, &$assetNames) {
            $response = $api->characters($this->character->id)->assets()->names()->data($asset->keys()->toArray())->post();
            $assetNames = $assetNames->merge($response->data);
        });

        $assetNames = $assetNames->recursive()->reject(function ($item) {
            return $item->get('name') === "None";
        })->keyBy('item_id');

        //clean up assets
        $this->character->assets()->delete();

        $newAssets = collect();
        $assets->each(function ($item) use (&$newAssets, $resolvedIds, $assetNames) {
            $i = [
                'item_id' => $item->get('item_id'),
                'location_id' => $item->get('location_id'),
                'location_type' => $item->get('location_type'),
                'location_flag' => $item->get('location_flag'),
                'location_name' => optional($resolvedIds->get($item->get('location_id'), null))->get('name'),
                'is_singleton' => $item->get('is_singleton'),
                'type_id' => $item->get('type_id'),
                'quantity' => $item->get('quantity'),
                'name' => optional($assetNames->get($item->get('item_id')), null)->get('name'),
            ];

            $newAssets->push($i);
        });

        $this->character->assets()->createMany($newAssets->toArray());
    }
}
