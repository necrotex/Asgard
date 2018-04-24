<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Silber\Bouncer\Database\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the silber bouncer database role.
     *
     * @param  \Asgard\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->can('view-roles');
    }

    /**
     * Determine whether the user can create silber bouncer database roles.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-roles');
    }

    /**
     * Determine whether the user can update the silber bouncer database role.
     *
     * @param  \Asgard\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return $user->can('update-roles');
    }

    /**
     * Determine whether the user can delete the silber bouncer database role.
     *
     * @param  \Asgard\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        return $user->can('delete-roles');
    }
}
