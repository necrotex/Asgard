<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Discord\Rename;
use Asgard\Jobs\Discord\UpdateUserRolesJob;
use Asgard\Models\User;
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
        $users = User::all();

        $delay = now();

        $users->reject(function ($user) {
            return is_null($user->discordAccount);
        })
            ->each(function ($user) use (&$delay) {
                $delay = $delay->addSeconds(5);
                dispatch(new Rename($user))->onQueue('high')->delay($delay);
                dispatch(new UpdateUserRolesJob($user))->onQueue('high')->delay($delay);
            });
    }
}
