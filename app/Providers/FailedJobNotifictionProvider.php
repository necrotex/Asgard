<?php

namespace Asgard\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\ServiceProvider;
use Queue;

class FailedJobNotifictionProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::failing(function(JobFailed $event){
            dd($event);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
