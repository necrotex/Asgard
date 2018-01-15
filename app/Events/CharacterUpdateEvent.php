<?php

namespace Asgard\Events;

use Asgard\Models\Character;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class CharacterUpdateEvent
{
    use Dispatchable, SerializesModels;

    public $character;

    /**
     * Create a new event instance.
     *
     * @param Character $character
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function hasChanged()
    {
        if(count($this->character->getDirty()) > 0)
            return true;

        return false;
    }

}
