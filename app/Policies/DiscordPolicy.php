<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\DiscordUser;
use Asgard\Support\SuperAdminPolicyTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscordPolicy
{
    use HandlesAuthorization, SuperAdminPolicyTrait;

    public function index(User $user) {
        return $user->can('access-discord');
    }

    /**
     * Determine whether the user can view the discordUser.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\DiscordUser  $discordUser
     * @return mixed
     */
    public function view(User $user, DiscordUser $discordUser)
    {
        return $user->can('access-discord') && $user->id == $discordUser->user_id;
    }

    /**
     * Determine whether the user can create discordUsers.
     *
     * @param  \Asgard\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('access-discord');
    }

    /**
     * Determine whether the user can update the discordUser.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\DiscordUser  $discordUser
     * @return mixed
     */
    public function update(User $user, DiscordUser $discordUser)
    {
        return $user->can('access-discord') && $user->id == $discordUser->user_id;
    }

    /**
     * Determine whether the user can delete the discordUser.
     *
     * @param  \Asgard\Models\User  $user
     * @param  \Asgard\Models\DiscordUser  $discordUser
     * @return mixed
     */
    public function delete(User $user, DiscordUser $discordUser)
    {
        return $user->can('access-discord') && $user->id == $discordUser->user_id;
    }
}
