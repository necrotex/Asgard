<?php

namespace Asgard\Jobs\Eve\Character;


use Asgard\Models\Character;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

abstract class CharacterUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $character;

    public function  __construct(Character $character)
    {
        $this->character = $character;
    }

    public function failed(Exception $exception)
    {
        Log::error(__CLASS__ . ': ' . $exception->getMessage(), $exception);

        activity('error')
            ->performedOn($this->character)
            ->withProperty('exception', $exception->getMessage())
            ->log("Job " . __CLASS__ . " failed");

        // if we have a client error, dispatch the next job in the chain
        if($exception->getCode() > 400 && $exception->getCode() < 500) {
            $this->dispatchNextJobInChain();
        }

        if($exception->getCode() > 500) {
            $this->release(500);
        }
    }
}