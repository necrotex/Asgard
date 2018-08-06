<?php

namespace Asgard\Console;

use Asgard\Jobs\Asgard\Haikus;
use Asgard\Jobs\Discord\Channels;
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
            ->everyFiveMinutes()
            ->withoutOverlapping(15)
            ->unlessBetween('10:45', '11:30');

        $schedule->command('asgard:update:status')
            ->everyFiveMinutes()
            ->withoutOverlapping(15)
            ->unlessBetween('10:45', '11:30');

        $schedule->command('asgard:update:character')
            ->everyThirtyMinutes()
            ->withoutOverlapping(60)
            ->unlessBetween('10:45', '11:30');

        $schedule->command('asgard:character:reimport')
            ->everyFifteenMinutes()
            ->withoutOverlapping(60)
            ->unlessBetween('10:45', '11:30');

        $schedule->command('asgard:corporation:members')
            ->hourly()
            ->withoutOverlapping(60)
            ->unlessBetween('10:45', '11:30');


        //horizon metrics
        $schedule->command('horizon:snapshot')->everyFiveMinutes();

        //$schedule->command('asgard:clean:reddit')->hourly(); //@todo
        $schedule->command('asgard:clean:timerboard')->everyMinute();
        $schedule->command('asgard:discord:fetch-roles')->daily();

        $schedule->command('activitylog:clean')->daily();

        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run --only-db --disable-notifications')->daily()->at('02:00');

        $schedule->job(new Haikus())->daily();
        $schedule->job(new Channels())->daily();

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
