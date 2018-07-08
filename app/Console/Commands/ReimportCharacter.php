<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Update\InitialImportJob;
use Asgard\Models\Character;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReimportCharacter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:character:reimport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tries to reimport characters that failed the inital import';

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
        // get all characters that failed to import and are older then 30 min
        $characters = Character::whereReady(false)->where('created_at', '<', Carbon::now()->subMinutes(30))->get();

        foreach ($characters as $character) {
            InitialImportJob::dispatch($character)->onQueue('high');
        }
    }
}
