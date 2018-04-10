<?php

namespace Asgard\Jobs\Update;

use Asgard\Jobs\Eve\CorporationHistory;
use Asgard\Jobs\Eve\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InitialCharacterSetup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $character;

    /**
     * Create a new job instance.
     *
     * @param \Asgard\Models\Character $character
     */
    public function __construct(\Asgard\Models\Character $character)
    {
        $this->character = $character;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dispatch_now(new Location($this->character));
        dispatch_now(new CorporationHistory($this->character));
    }
}
