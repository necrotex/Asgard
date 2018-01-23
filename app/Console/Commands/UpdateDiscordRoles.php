<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Discord\FetchRoles;
use Illuminate\Console\Command;

class UpdateDiscordRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:discord:fetch-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncronizes discord roles';

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
        dispatch(new FetchRoles());
    }
}
