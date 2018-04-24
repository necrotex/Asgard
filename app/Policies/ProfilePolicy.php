<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->can('see-profiles') || $model->id == $user->id;
    }

    public function update(User $user, User $model)
    {
        return $model->id == $user->id;
    }
}
