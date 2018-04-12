<?php

namespace Asgard\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //run jobs except during downtime
        $schedule->command('asgard:update:location')
            ->everyMinute()
            ->unlessBetween('11:00', '11:30');

        $schedule->command('asgard:update:status')
            ->everyMinute()
            ->unlessBetween('11:00', '11:30');

        $schedule->command('asgard:update:character')
            ->everyThirtyMinutes()
            //->withoutOverlapping(60) //@todo: enable again
            ->unlessBetween('11:00', '11:30');



        //$schedule->command('asgard:clean:reddit')->hourly(); //@todo
        //$schedule->command('asgard:clean:timerboard')->everyMinute(); //@todo
        //$schedule->command('asgard:discord:fetch-roles')->daily(); //@todo

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
