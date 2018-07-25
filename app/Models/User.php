<?php

namespace Asgard\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = ['mainCharacter'];


    public function getRouteKey()
    {
        return $this->getAttribute('name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function discordAccount()
    {
        return $this->hasOne(DiscordUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function redditAccount()
    {
        return $this->hasOne(RedditUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainCharacter()
    {
        return $this->hasOne(Character::class, 'id', 'main_character');
    }

    /**
     * @param $ability
     * @return bool
     */
    public function roleCan($ability)
    {
        $roles = $this->getCombinedRoles();

        foreach ($roles as $role) {

            if ($role->can($ability)) {
                return true;
            }
        }

        return false;
    }

    public function can($ability, $arguments = [])
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($ret = parent::can($ability, $arguments)) {
            return $ret;
        }

        return $this->roleCan($ability);
    }

    public function isSuperAdmin()
    {
        return parent::can('access-everything') || $this->roleCan('access-everything');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAssociatedRoles()
    {
        $corpRoles = collect();

        $this->characters->each(function ($character) use (&$corpRoles) {
            if (!is_null($character->systemCorporation)) {
                $corpRoles = $corpRoles->merge($character->systemCorporation->roles->values());
            }
        });

        return $corpRoles->keyBy('id')->unique();
    }

    public function getCombinedRoles()
    {
        return $this->roles->merge($this->getAssociatedRoles())->unique()->values();
    }

    /**
     * @return mixed
     */
    public function getUserDiscordRoles()
    {
        return UserDiscordRoles::where('user_id', '=', $this->id)->get();
    }

    /**
     * @return mixed
     */
    public function getAssociatedDiscordRoles()
    {
        $inheritedRoles = $this->getAssociatedRoles();

        $roleIds = collect();

        foreach ($inheritedRoles as $role) {
            $roleDiscordRole = RoleDiscordRole::where('role_id', '=', $role->id)->get();
            foreach ($roleDiscordRole as $rdr) {
                $roleIds->push($rdr->discord_role_id);
            }
        }

        return DiscordRoles::whereIn('id', $roleIds->unique()->values()->all())->get();
    }

    /**
     * @return array
     */
    public function getDiscordRolesAsArray()
    {
        $roles = [];

        $userRoles = $this->getAssociatedDiscordRoles();

        foreach ($userRoles as $userRole) {
            $roles[] = $userRole->discord_id;
        }

        return array_unique($roles);
    }

    public function application()
    {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    public function latestApplication()
    {
        return $this->hasMany(Application::class, 'user_id', 'id')->latest();
    }

    public function invites()
    {
        return $this->hasMany(UserInvitation::class, 'user_id', 'id');
    }
}

