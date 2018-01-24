<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class UserDiscordRoles extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'discord_role_id'];
}
