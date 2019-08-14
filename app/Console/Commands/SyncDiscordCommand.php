<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Discord\Channels;
use Asgard\Jobs\Discord\SyncUsers;
use Illuminate\Console\Command;

class SyncDiscordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:sync:discord';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs discord users with auth.';

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
        dispatch_now(new SyncUsers());
        dispatch_now(new Channels());
    }
}
