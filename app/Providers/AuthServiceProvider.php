<?php

namespace Asgard\Providers;

use Asgard\Models\Character\Mail;
use Asgard\Models\Corporation;
use Asgard\Models\DiscordUser;
use Asgard\Models\Setting;
use Asgard\Models\User;
use Asgard\Policies\CharacterMailPolicy;
use Asgard\Policies\CorporationPolicy;
use Asgard\Policies\DiscordPolicy;
use Asgard\Policies\RolePolicy;
use Asgard\Policies\SettingPolicy;
use Asgard\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Silber\Bouncer\Database\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
