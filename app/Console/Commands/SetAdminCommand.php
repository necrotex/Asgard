<?php

namespace Asgard\Console\Commands;

use Asgard\Models\Character;
use Illuminate\Console\Command;

class SetAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:admin {character_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets a character as super admin';

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
        $char_id = $this->argument('character_id');

        $char = Character::findOrFail($char_id);

        $this->info("Setting {$char->name} as admin");

        $char->user->assign("admin");

        $this->info('Done!');
    }
}
