<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Eve\Status;
use Asgard\Models\User;
use Illuminate\Console\Command;

class UpdateOnlineStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Character Online Status';

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
        $users = User::all();

        foreach($users as $user) {
            foreach($user->characters as $character) {
                dispatch(new Status($character));
            }
        }
    }
}
