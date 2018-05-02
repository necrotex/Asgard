<?php

namespace Asgard\Jobs\Update;

use Conduit\Authentication;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Asgard\Models\Character as CharacterModel;

class Character implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $character;

    /**
     * Create a new job instance.
     *
     * @param CharacterModel $character
     */
    public function __construct(CharacterModel $character)
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
        Log::info($this->character->id . ' about to update');

        $data = $api->characters($this->character->id)->get();

        $this->character->corporation_id = $data->corporation_id;
        $this->character->save();

        $corp_data = $api->corporations($this->character->corporation_id)->get();

        CharacterModel\Corporation::updateOrCreate(
            [
                'character_id' => $this->character->id,
            ],
            [
                'corporation_id' => $corp_data->get('id'),
                'name' => $corp_data->get('name'),
                'ticker' => $corp_data->get('ticker'),
            ]
        );

    }
}
