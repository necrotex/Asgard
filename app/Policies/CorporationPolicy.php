<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\Corporation;
use Asgard\Support\SuperAdminPolicyTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class CorporationPolicy
{
    use HandlesAuthorization, SuperAdminPolicyTrait;

    public function index(User $user) {
        return $user->can('see-corporation');
    }

    /**
     * Determine whether the user can view the corporation.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Corporation  $corporation
     * @return mixed
     */
    public function view(User $user, Corporation $corporation)
    {
        return $user->can('see-corporation');
    }

    public function show(User $user, Corporation $corporation)
    {
        return $user->can('see-corporation');
    }

    /**
     * Determine whether the user can create corporations.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-corporation');
    }

    /**
     * Determine whether the user can update the corporation.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Corporation  $corporation
     * @return mixed
     */
    public function update(User $user, Corporation $corporation)
    {
        return $user->can('update-corporation');

    }

    /**
     * Determine whether the user can delete the corporation.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Corporation  $corporation
     * @return mixed
     */
    public function delete(User $user, Corporation $corporation)
    {
        return $user->can('delete-corporation');
    }
}
