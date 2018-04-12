<?php

namespace Asgard\Console\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the Application';

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
        $this->info('Setting up database');
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('eve:update-sde');
        $this->call('queue:restart');

    }
}
