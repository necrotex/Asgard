<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\ApplicationForm;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationFormPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the models application form.
     *
     * @param  \Asgard\Models\User $user
     * @param ApplicationForm $applicationForm
     * @return mixed
     */
    public function view(User $user, ApplicationForm $applicationForm)
    {
        return $user->can('view-application-forms');
    }

    /**
     * Determine whether the user can create models application forms.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-application-forms');
    }

    /**
     * Determine whether the user can update the models application form.
     *
     * @param  \Asgard\Models\User $user
     * @param ApplicationForm $applicationForm
     * @return mixed
     */
    public function update(User $user, ApplicationForm $applicationForm)
    {
        return $user->can('update-application-forms');
    }

    /**
     * Determine whether the user can delete the models application form.
     *
     * @param  \Asgard\Models\User $user
     * @param ApplicationForm $applicationForm
     * @return mixed
     */
    public function delete(User $user, ApplicationForm $applicationForm)
    {
        //
    }
}
