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

class Titles implements ShouldQueue
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

        $response = $api->characters($this->character->id)->titles()->get();

        $titles = $this->character->titles;

        $titleIds = [];

        foreach ($response->data as $remoteTitle) {
            $titleIds[] = $remoteTitle->title_id;

            Character\Title::firstOrCreate(
                [
                    'character_id' => $this->character->id,
                    'title_id' => $remoteTitle->title_id
                ],
                [
                    'name' => $remoteTitle->name
                ]
            );
        }

        foreach ($titles as $title) {
            if (!in_array($title->title_id, $titleIds)) {
                $title->delete();
            }
        }

    }
}
