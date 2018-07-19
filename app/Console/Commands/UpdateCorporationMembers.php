<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Eve\Corporation\Members;
use Asgard\Models\Corporation;
use Illuminate\Console\Command;

class UpdateCorporationMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:corporation:members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Corporation Members';

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
        $corps = Corporation::all();

        foreach ($corps as $corp) {
            Members::dispatch($corp)->onQueue('low');
        }
    }
}
