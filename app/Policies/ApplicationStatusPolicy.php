<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationStatusPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->can('view-application');
    }
}
