<?php

namespace Asgard\Jobs\Eve;

use Asgard\Jobs\Update\Corporation as UpdateCorporationJob;
use Asgard\Models\Character;
use Asgard\Models\Corporation as CorporationModel;
use Carbon\Carbon;
use Conduit\Authentication;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CorporationHistory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $auth = new Authentication(
            config('services.eveonline.client_id'),
            config('services.eveonline.client_secret'),
            $this->character->refresh_token);

        $api->setAuthentication($auth);

        $response = $api->characters($this->character->id)->corporationhistory()->get();


        $corps = [];
        foreach($response->data as $data) {
            $corp = CorporationModel::firstOrNew(['id' => $data->corporation_id]);

            if(!$corp->exists) {
                $corp[] = new UpdateCorporationJob($data->corporation_id); //todo: figure out why this doesn't work
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

        $this->chain($corps);
    }
}
