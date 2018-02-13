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

class Fatigue implements ShouldQueue
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

        $response = $api->characters($this->character->id)->fatigue()->get();

        $last_jump_date = ($response->get('last_jump_date', false)) ? Carbon::parse($response->get('last_jump_date')) : null;
        $jump_fatigue_expire_date = ($response->get('jump_fatigue_expire_date', false)) ? Carbon::parse($response->get('jump_fatigue_expire_date')) : null;
        $last_update_date = ($response->get('last_update_date', false)) ? Carbon::parse($response->get('last_update_date')) : null;

        Character\Fatigue::firstOrCreate(
            [
                'character_id' => $this->character->id
            ],
            [
                'last_jump_date' => $last_jump_date,
                'jump_fatigue_expire_date' => $jump_fatigue_expire_date,
                'last_update_date' => $last_update_date,
            ]
        );

    }
}
