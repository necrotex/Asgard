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

/**
 * @property  character
 */
class Skillqueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;
    protected $character;

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

        $response = $api->characters($this->character->id)->skillqueue()->get();

        //completely remove skillqueue for the character for each update
        Character\Skillqueue::where('character_id', '=', $this->character->id)->delete();

        $data = [];
        foreach($response->data as $entry) {
            $item = get_object_vars($entry);
            $item['character_id'] = $this->character->id;

            if(array_key_exists('start_date', $item)) {
                $item['start_date'] = Carbon::parse($item['start_date']);
            }

            if(array_key_exists('finish_date', $item)) {
                $item['finish_date'] = Carbon::parse($item['finish_date']);
            }


            $data[] = $item;
        }

        Character\Skillqueue::insert($data);

    }
}
