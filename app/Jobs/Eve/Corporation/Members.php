<?php

namespace Asgard\Jobs\Eve\Corporation;

use Asgard\Models\Corporation;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Members implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;

    public $corporation;

    /**
     * Create a new job instance.
     *
     * @param Corporation $corporation
     */
    public function __construct(Corporation $corporation)
    {
        $this->corporation = $corporation;
    }

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        // we use the ceo for corporation requests, if he isn't in the system use the frist character of the corp for now
        if (($character = $this->corporation->ceo) == null) {
            $character = $this->corporation->characters()->whereActive(true)->first();
        }

        $api->setAuthentication($this->getAuthentication($character));

        $response = $api->corporations($this->corporation->id)->members()->get();
        $memberIds = collect($response->data);

        $response = $api->universe()->names()->data($memberIds->toArray())->post();
        $members = collect($response->data)->recursive()->keyBy('id');

        $members = $members->values()->map(function ($item) {
            return $item->only(['id', 'name']);
        });

        $this->corporation->members()->delete();
        $this->corporation->members()->createMany($members->toArray());
    }
}
