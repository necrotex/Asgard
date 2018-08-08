<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\Feedback;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the feedback.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Feedback  $feedback
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('see-feedback');
    }

    /**
     * Determine whether the user can create feedback.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-feedback');
    }

    /**
     * Determine whether the user can update the feedback.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Feedback  $feedback
     * @return mixed
     */
    public function update(User $user, Feedback $feedback)
    {
        //
    }

    /**
     * Determine whether the user can delete the feedback.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Feedback  $feedback
     * @return mixed
     */
    public function delete(User $user, Feedback $feedback)
    {
        //
    }

    /**
     * Determine whether the user can restore the feedback.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Feedback  $feedback
     * @return mixed
     */
    public function restore(User $user, Feedback $feedback)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the feedback.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Feedback  $feedback
     * @return mixed
     */
    public function forceDelete(User $user, Feedback $feedback)
    {
        //
    }
}
