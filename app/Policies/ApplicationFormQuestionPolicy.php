<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationFormQuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the application form question.
     *
     * @param  \Asgard\Models\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view-application-form-questions');
    }

    /**
     * Determine whether the user can create application form questions.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-application-form-questions');
    }

    /**
     * Determine whether the user can update the application form question.
     *
     * @param  \Asgard\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update-application-form-questions');
    }

    /**
     * Determine whether the user can delete the application form question.
     *
     * @param  \Asgard\Models\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can('delete-application-form-questions');
    }
}
