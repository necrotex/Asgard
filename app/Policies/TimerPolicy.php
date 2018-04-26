<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\Timer;
use Illuminate\Auth\Access\HandlesAuthorization;

//@todo: implement access logic
class TimerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the timer.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function view(User $user, $timer)
    {
        //@todo: resolve hash  id to timer model
        return $user->can('view-timer');
    }

    /**
     * Determine whether the user can create timers.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-timer');
    }

    /**
     * Determine whether the user can update the timer.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Timer  $timer
     * @return mixed
     */
    public function update(User $user, Timer $timer)
    {
        return $user->can('update-timer');

    }

    /**
     * Determine whether the user can delete the timer.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Timer  $timer
     * @return mixed
     */
    public function delete(User $user, Timer $timer)
    {
        return $user->can('delete-timer');
    }
}
