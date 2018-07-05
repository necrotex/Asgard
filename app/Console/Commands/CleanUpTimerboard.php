<?php

namespace Asgard\Console\Commands;

use Asgard\Models\Timer;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CleanUpTimerboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:clean:timerboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all expired timers';

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
     * @throws \Exception
     */
    public function handle()
    {
        Timer::where('target', '<', Carbon::now('UTC')->subDay(1))->delete();
    }
}
