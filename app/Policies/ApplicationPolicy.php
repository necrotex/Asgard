<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the application.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Application  $application
     * @return mixed
     */
    public function view(User $user, Application $application)
    {
        return $user->can('view-application');
    }

    /**
     * Determine whether the user can create applications.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //$invite = auth()->user()->invites()->where('completed', false)->first()->exists();

        //return optional($invite)->exists();
        $return = optional($user->invites()->where('completed', false)->first())->exists();

        return !is_null($return);
    }

    /**
     * Determine whether the user can update the application.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Application  $application
     * @return mixed
     */
    public function update(User $user, Application $application)
    {
        return $user->can('update-application');
    }

    /**
     * Determine whether the user can delete the application.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Application  $application
     * @return mixed
     */
    public function delete(User $user, Application $application)
    {
        return $user->can('delete-application');
    }
}
