<?php

namespace Asgard\Providers;

use Asgard\Models\Application;
use Asgard\Models\ApplicationComment;
use Asgard\Models\ApplicationForm;
use Asgard\Models\ApplicationFormQuestion;
use Asgard\Models\ApplicationStatus;
use Asgard\Models\Character;
use Asgard\Models\Corporation;
use Asgard\Models\Setting;
use Asgard\Models\Timer;
use Asgard\Models\User;
use Asgard\Policies\ApplicationCommentPolicy;
use Asgard\Policies\ApplicationFormQuestionPolicy;
use Asgard\Policies\ApplicationPolicy;
use Asgard\Policies\ApplicationStatusPolicy;
use Asgard\Policies\CharacterMailPolicy;
use Asgard\Policies\CharacterPolicy;

use Asgard\Policies\CorporationPolicy;
use Asgard\Policies\ProfilePolicy;

use Asgard\Policies\RolePolicy;
use Asgard\Policies\SettingsPolicy;
use Asgard\Policies\TimerPolicy;
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
        User::class => ProfilePolicy::class,
        Character::class => CharacterPolicy::class,
        Corporation::class => CorporationPolicy::class,
        Role::class => RolePolicy::class,
        ApplicationForm::class => ApplicationFormQuestionPolicy::class,
        ApplicationFormQuestion::class => ApplicationFormQuestionPolicy::class,
        Setting::class => SettingsPolicy::class,
        Timer::class => TimerPolicy::class,
        Application::class => ApplicationPolicy::class,
        ApplicationComment::class => ApplicationCommentPolicy::class,
        ApplicationStatus::class => ApplicationStatusPolicy::class,
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
