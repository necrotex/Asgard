<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\Character;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the character.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Character  $character
     * @return mixed
     */
    public function view(User $user, Character $character)
    {
        return $user->can('view-characters') || $user->id == $character->user->id;
    }

    /**
     * Determine whether the user can create characters.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('add-characters');
    }

    /**
     * Determine whether the user can update the character.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Character  $character
     * @return mixed
     */
    public function update(User $user, Character $character)
    {
        return $user->id == $character->user->id;
    }

    /**
     * Determine whether the user can delete the character.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\Character  $character
     * @return mixed
     */
    public function delete(User $user, Character $character)
    {
        return $user->id == $character->user->id;
    }
}
