<?php

namespace Asgard\Jobs\Eve\Character;


use Asgard\Models\Character;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

abstract class CharacterUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $character;
    public $tries = 1;
    public $timeout = 120; //@todo: find a reasonable timeframe for the timeout

    public function  __construct(Character $character)
    {
        $this->character = $character;
    }
}