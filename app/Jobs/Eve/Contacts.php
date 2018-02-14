<?php

namespace Asgard\Jobs\Eve;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Contacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;

    public $character;

    /**
     * Create a new job instance.
     *
     * @param Character $character
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

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
        $labels = $api->characters($this->character->id)->contacts()->labels()->get();

        $contactIds = [];
        foreach ($response->data as $contact) {

            //skip factions, no body cares about them anyway
            if($contact->contact_type == 'faction') continue;

            switch ($contact->contact_type) {
                case 'character':
                    $data = $api->characters($contact->contact_id)->get();
                    $name = $data->get('name');
                    break;
                case 'corporation':
                    $data = $api->corporations($contact->contact_id)->get();
                    $name = $data->get('name');
                    break;
                case 'alliance':
                    $data = $api->alliances($contact->contact_id)->get();
                    $name = $data->get('name');
                    break;
                default:
                    $name = 'n/a';
            }

            $label = null;
            if(property_exists($contact, 'label_id')) {
                foreach($labels as $l) {
                    if($l->label_id == $contact->label_id) {
                        $label = $l->label_name;
                        break;
                    }
                }
            }

            Character\Contact::updateOrCreate(
                [
                    'character_id' => $this->character->id,
                    'contact_id' => $contact->contact_id
                ],
                [
                    'contact_type' => $contact->contact_type,
                    'standing' => $contact->standing,
                    'name' => $name,
                    'label' => $label
                ]
            );

            $contactIds[] = $contact->contact_id;
        }

        Character\Contact::where('character_id', '=', $this->character->id)
            ->whereNotIn('contact_id', $contactIds)
            ->delete();
    }
}
