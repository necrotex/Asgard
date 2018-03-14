<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Eve\Contacts;
use Asgard\Jobs\Eve\CorporationHistory;
use Asgard\Jobs\Eve\CorporationRoles;
use Asgard\Jobs\Eve\Fatigue;
use Asgard\Jobs\Eve\Mails;
use Asgard\Jobs\Eve\Skillqueue;
use Asgard\Jobs\Eve\Skills;
use Asgard\Jobs\Eve\Titles;
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
            dispatch(new UpdateCharacterJob($character))
                ->chain(
                    [
                        new Skills($character),
                        new Skillqueue($character),
                        new CorporationHistory($character),
                        new Fatigue($character),
                        new CorporationRoles($character),
                        new Titles($character),
                        new Contacts($character),
                        new Mails($character)
                    ]
            );
        }
    }
}
