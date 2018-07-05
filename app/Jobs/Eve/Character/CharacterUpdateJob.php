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

    public function  __construct(Character $character)
    {
        $this->character = $character;
    }

    public function failed(Exception $exception)
    {
        if($exception->getCode() > 500) {
            $this->release(500);
        }

        activity('error')
            ->performedOn($this->character)
            ->withProperty('exception', $exception->getMessage())
            ->log("Job " . __CLASS__ . " failed");
    }
}