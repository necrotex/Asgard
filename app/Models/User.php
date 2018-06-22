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
        $roles = $this->getAssociatedRoles();
        $roles->merge($this->roles);

        //todo: how should we handle forbidden abilities etc

        foreach ($roles as $role) {

            if ($role->can($ability)) {
                return true;
            }
        }

        return false;
    }

    public function can($ability, $arguments = [])
    {
        if($this->isSuperAdmin()) {
            return true;
        }

        if($ret = parent::can($ability, $arguments)) {
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
        $roles = collect();

        foreach($this->roles as $role) {
            $roles->push($role);
        }

        foreach ($this->characters as $character) {
            $corp = $character->systemCorporation;

            //not all characters have corps added to the system
            if (!$corp) continue;

            $inheritedRoles = $corp->roles;

            foreach ($inheritedRoles as $ir) {
                $roles->push($ir);
            }
        }

        //remove redundant roles
        foreach ($roles as $i => $role) {
            foreach ($roles as $k => $role2) {
                if ($i == $k) continue;

                if ($role->id == $role2->id)
                    $roles->pull($i);
            }
        }

        return $roles;
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

    public function invites()
    {
        return $this->hasMany(UserInvitation::class, 'user_id', 'id');
    }
}

