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

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function discordAccount() {
        return $this->hasOne(DiscordUser::class);
    }

    public function redditAccount() {
        return $this->hasOne(RedditUser::class);
    }

    public function mainCharacter()
    {
        return $this->hasOne(Character::class, 'id', 'main_character');
    }

    public function getAssociatedRoles()
    {
        $roles = collect();

        foreach($this->characters as $character) {
            $corp = $character->corporation;

            //not all characters have corps added to the system
            if(!$corp) continue;

            $inheritedRoles = $corp->roles;

            foreach($inheritedRoles as $ir) {
                $roles->push($ir);
            }
        }

        //remove redudent roles
        foreach ($roles as $i => $role) {
            foreach($roles as $k => $role2){
                if($i == $k) continue;

                if($role->id == $role2->id)
                    $roles->pull($i);
            }
        }

        return $roles;
    }

    public function getUserDiscordRoles()
    {
        return UserDiscordRoles::where('user_id', '=', $this->id)->get();
    }

    public function getAssociatedDiscordRoles()
    {
        $inheritedRoles = $this->getAssociatedRoles();

        $roleIds = collect();
        foreach ($inheritedRoles as $role) {
            $roleDiscordRole = RoleDiscordRole::where('role_id', '=', $role->id)->get();
            foreach($roleDiscordRole as $rdr) {
                $roleIds->push($rdr->role_id);
            }
        }

        return DiscordRoles::whereIn('id', $roleIds->unique()->values()->all())->get();
    }

    public function getDiscrodRoles()
    {

    }
}

