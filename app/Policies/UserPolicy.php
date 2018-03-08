<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability) {
        if($user->can('access-everything') || $user->roleCan('access-everything')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->id == $model->id || $user->can('see-users');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }
}
