<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Eve\Character\Location;
use Asgard\Models\User;
use Illuminate\Console\Command;

class UpdateCharacterLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:update:location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Character locations';

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

                dispatch(new Location($character))->onQueue('low');
            }
        }
    }
}
