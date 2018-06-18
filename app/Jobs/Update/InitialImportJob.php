<?php

namespace Asgard\Jobs\Update;

use Asgard\Jobs\Eve\Character\Assets;
use Asgard\Jobs\Eve\Character\Contacts;
use Asgard\Jobs\Eve\Character\CorporationHistory;
use Asgard\Jobs\Eve\Character\CorporationRoles;
use Asgard\Jobs\Eve\Character\Fatigue;
use Asgard\Jobs\Eve\Character\Journal;
use Asgard\Jobs\Eve\Character\Location;
use Asgard\Jobs\Eve\Character\Mails;
use Asgard\Jobs\Eve\Character\Skillqueue;
use Asgard\Jobs\Eve\Character\Skills;
use Asgard\Jobs\Eve\Character\Status;
use Asgard\Jobs\Eve\Character\Titles;
use Asgard\Jobs\Eve\Character\Transactions;
use Asgard\Jobs\Eve\Character\Wallet;
use Asgard\Jobs\Update\VerifyTokenJob;
use Asgard\Models\Character;
use Asgard\Support\SendsSystemMessage;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InitialImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SendsSystemMessage;

    /**
     * @var Character
     */
    public $character;

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
     * @return void
     */
    public function handle()
    {
        VerifyTokenJob::withChain(
            [
                new \Asgard\Jobs\Update\Character($this->character),
                new Location($this->character),
                new Status($this->character),
                new Skills($this->character),
                new Skillqueue($this->character),
                new CorporationHistory($this->character),
                new CorporationRoles($this->character),
                new Fatigue($this->character),
                new Titles($this->character),
                new Contacts($this->character),
                new Assets($this->character),
                new Wallet($this->character),
                new Journal($this->character),
                new Transactions($this->character),
                new Mails($this->character),
                new CharacterReadyJob($this->character)
            ]
        )->dispatch($this->character)->allOnQueue('high');
    }

    // retry adding the character for 20 min until the job fails
    public function retryUntil()
    {
        return now()->addMinutes(20); //@todo: this probably should be a config value
    }

    public function failed(Exception $exception)
    {
        $this->notifySystem('error', 'Inital import for ' . $this->character->name . 'failed', $exception->getMessage());
    }
}
