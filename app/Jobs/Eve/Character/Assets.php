<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character\Asset;
use Asgard\Support\ConduitAuthTrait;
use Asgard\Support\EVEOnlineIDs;
use Conduit\Conduit;
use Log;

class Assets extends CharacterUpdateJob {

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

        $result = $api->characters($this->character->id)->assets()->get();

        $pages = (int) $result->getHeader('X-Pages');
        $data = $result->data;

        if($pages > 1) {
           for($i=2; $i<=$pages; $i++) {
               $result = $api->characters($this->character->id)
                   ->assets()
                   ->query(['page' => $i])
                   ->get();

               $data = array_merge($data, $result->data);
           }
        }

        $ordered = [];
        $packaged = [];
        $other = [];

        $location_ids = [];
        foreach ($data as $item) {
            // if the id is in the rage of stations
            if($item->location_id < 61000000) {
                if($item->is_singleton === false) {
                    $packaged[] = $item;
                } else {
                    $ordered[$item->item_id][] = $item;
                }

                $location_ids[] = $item->location_id;
            } else {
                $other[] = $item;
            }
        }

        foreach($other as $item) {
            //if it above the range of stations
            if($item->location_id > 61000000) {
                $ordered[$item->location_id][] = $item;
            }
        }

        $orderLocaltionIds = EVEOnlineIDs::sort(array_unique($location_ids));

        Log::debug('Asset Location Ids: ' . print_r($orderLocaltionIds, true));

        $res = $api->universe()->names()->data($orderLocaltionIds['stations'])->post();
        $this->locations = $res->data;

        // remove all assets for the character
        Asset::where('character_id', '=', $this->character->id)->delete();

        foreach($packaged as $item) {
            $this->addItem($item);
        }

        foreach($ordered as $group) {
            foreach($group as $key => $item) {
                // the first element in each grouping is the parent
                if($key == 0) {
                    $this->addItem($item);
                } else {
                    $this->addItem($item, $group[0]->item_id);
                }
            }
        }
    }

    private function addItem($item, $parent = null) {
        Asset::insert([
            'type_id' => $item->type_id,
            'character_id' => $this->character->id,
            'quantity' => $item->quantity,
            'location_id' => $item->location_id,
            'location_type' => $item->location_type,
            'item_id' => $item->item_id,
            'location_flag' => $item->location_flag,
            'is_singleton' => $item->is_singleton,

            'related_asset' => $parent,
            'location_name' => $this->findLocation($item->location_id)

            // $table->string('name')->nullable(); // This is way to much work for now, maybe later
        ]);
    }

    private function findLocation(int $id) {
        foreach($this->locations as $location) {
            if($id == $location->id) {
                return $location->name;
            }
        }

        return null;
    }
}
