<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Eve\Character\Assets;
use Asgard\Jobs\Eve\Character\Contacts;
use Asgard\Jobs\Eve\Character\CorporationHistory;
use Asgard\Jobs\Eve\Character\CorporationRoles;
use Asgard\Jobs\Eve\Character\Fatigue;
use Asgard\Jobs\Eve\Character\Journal;
use Asgard\Jobs\Eve\Character\Mails;
use Asgard\Jobs\Eve\Character\Skillqueue;
use Asgard\Jobs\Eve\Character\Skills;
use Asgard\Jobs\Eve\Character\Titles;
use Asgard\Jobs\Eve\Character\Transactions;
use Asgard\Jobs\Eve\Character\Wallet;
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
            UpdateCharacterJob::dispatch($character)->allOnQueue('low');
            Skills::dispatch($character)->allOnQueue('low');
            Skillqueue::dispatch($character)->allOnQueue('low');
            CorporationHistory::dispatch($character)->allOnQueue('low');
            Fatigue::dispatch($character)->allOnQueue('low');
            CorporationRoles::dispatch($character)->allOnQueue('low');
            Titles::dispatch($character)->allOnQueue('low');
            Contacts::dispatch($character)->allOnQueue('low');
            Assets::dispatch($character)->allOnQueue('low');
            Mails::dispatch($character)->allOnQueue('low');
            Wallet::dispatch($character)->allOnQueue('low');
            Journal::dispatch($character)->allOnQueue('low');
            Transactions::dispatch($character)->allOnQueue('low');
        }
    }
}
