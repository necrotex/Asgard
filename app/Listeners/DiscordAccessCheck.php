<?php

namespace Asgard\Listeners;

use Asgard\Events\CharacterUpdateEvent;
use Asgard\Jobs\Discord\UpdateUserRolesJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class DiscordAccessCheck implements ShouldQueue
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
        Log::debug('Event fired ' . self::class);

        if($event->hasChanged()) {
            //dispatch(new UpdateUserRolesJob($event->character->user))->onQueue('low');
        }
    }
}
