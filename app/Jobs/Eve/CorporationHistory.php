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
     * @return void
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function handle(Conduit $api)
    {
        $api->setAuthentication($this->getAuthentication($this->character));

        $response = $api->characters($this->character->id)->corporationhistory()->get();

        foreach($response->data as $data) {
            $corp = CorporationModel::firstOrNew(['id' => $data->corporation_id]);

            if(!$corp->exists) { //todo: don't save them into the corporation table, just get the name etc
                dispatch_now(new UpdateCorporationJob($data->corporation_id));
            }

            Character\CorporationHistory::firstOrCreate(
                [
                    'record_id' => $data->record_id,
                    'character_id' => $this->character->id
                ],
                [
                    'corporation_id' => $data->corporation_id,
                    'start_date' => Carbon::parse($data->start_date),
                ]
            );
        }
    }
}
