<?php

namespace Asgard\Jobs\Eve;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Transactions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;

    /**
     * @var Character
     */
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

        $result = $api->characters($this->character->id)->wallet()->transactions()->get();

        foreach ($result->data as $entry) {
            Character\Transaction::firstOrCreate(
                [
                    'transaction_id' => data_get($entry, 'transaction_id', null),
                    'character_id' => $this->character->id
                ],
                [
                    'date' => Carbon::parse(data_get($entry, 'date', null)),
                    'type_id' => data_get($entry, 'type_id', null),
                    'location_id' => data_get($entry, 'location_id', null),
                    'unit_price' => data_get($entry, 'unit_price', null),
                    'quantity' => data_get($entry, 'quantity', null),
                    'ref_id' => data_get($entry, 'ref_id', null),
                    'client_id' => data_get($entry, 'client_id', null),
                    'is_buy' => data_get($entry, 'is_buy', null),
                    'is_personal' => data_get($entry, 'is_personal', null),
                    'journal_ref_id' => data_get($entry, 'journal_ref_id', null),
                ]
            );

        }
    }
}
