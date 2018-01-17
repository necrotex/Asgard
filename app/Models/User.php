<?php

namespace Asgard\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
}
