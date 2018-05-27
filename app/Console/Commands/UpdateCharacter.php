<?php

namespace Asgard\Console\Commands;

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
use Asgard\Jobs\Update\Character as UpdateCharacterJob;
use Illuminate\Console\Command;


class UpdateCharacter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:update:character';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update characters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $characters = Character::where('active', true)->get();

        foreach($characters as $character) {

            VerifyTokenJob::withChain(
                [
                    new UpdateCharacterJob($character),
                    new Location($character),
                    new Status($character),
                    new Skills($character),
                    new Skillqueue($character),
                    new CorporationHistory($character),
                    new CorporationRoles($character),
                    new Fatigue($character),
                    new Titles($character),
                    new Contacts($character),
                    new Assets($character),
                    new Wallet($character),
                    new Journal($character),
                    new Transactions($character),
                    new Mails($character),
                ]
            )->dispatch($character)->allOnQueue('low');
        }

        // update timestamps
        $character->touch();
    }
}
