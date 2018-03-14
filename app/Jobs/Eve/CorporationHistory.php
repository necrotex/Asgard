<?php

namespace Asgard\Jobs\Eve;

use Asgard\Jobs\Update\Corporation as UpdateCorporationJob;
use Asgard\Models\Character;
use Asgard\Models\Corporation as CorporationModel;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CorporationHistory implements ShouldQueue
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

        $response = $api->characters($this->character->id)->corporationhistory()->get();

        foreach($response->data as $data) {

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
