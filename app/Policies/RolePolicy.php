<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Support\SuperAdminPolicyTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Silber\Bouncer\Database\Role;

class RolePolicy
{
    use HandlesAuthorization, SuperAdminPolicyTrait;

    public function index(User $user) {
        return $user->can('see-roles');
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \Asgard\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->can('see-roles');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-roles');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return $user->can('update-roles');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        return $user->can('delete-roles');
    }
}
