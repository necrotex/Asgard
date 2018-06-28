<?php

namespace Asgard\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Asgard\Events\CharacterUpdateEvent' => [
            'Asgard\Listeners\RedditAccessCheck',
            'Asgard\Listeners\DiscordAccessCheck',
        ],

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\Discord\DiscordExtendSocialite@handle',
            'SocialiteProviders\Reddit\RedditExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
