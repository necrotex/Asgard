<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(User $user)
    {
        return $user->can('view-application');
    }
}
