<?php

namespace Asgard\Providers;

use Asgard\Models\Corporation;
use Asgard\Models\Setting;
use Asgard\Models\User;
use Asgard\Policies\CorporationPolicy;
use Asgard\Policies\RolePolicy;
use Asgard\Policies\SettingPolicy;
use Asgard\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
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
        User::class => UserPolicy::class,
        Corporation::class => CorporationPolicy::class,
        Role::class, RolePolicy::class,
        Setting::class, SettingPolicy::class,
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
