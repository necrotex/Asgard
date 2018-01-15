<?php

namespace Asgard\Listeners;

use Asgard\Events\CharacterUpdateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamspeakAccessCheck
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CharacterUpdateEvent  $event
     * @return void
     */
    public function handle(CharacterUpdateEvent $event)
    {
        //
    }
}
