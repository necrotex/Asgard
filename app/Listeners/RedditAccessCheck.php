<?php

namespace Asgard\Listeners;

use Asgard\Events\CharacterUpdateEvent;
use Asgard\Jobs\Reddit\AddApprovedSubmitterJob;
use Asgard\Jobs\Reddit\RemoveApprovedSubmitterJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class RedditAccessCheck implements ShouldQueue
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
        Log::info('Event fired ' . self::class);

        if($event->hasChanged()) {

            if($event->character->user->roleCan('access-subreddit')) {
                dispatch(new AddApprovedSubmitterJob($event->character->user->redditAccount));
            } else {
                dispatch(new RemoveApprovedSubmitterJob($event->character->user->redditAccount));
            }

        }
    }
}
