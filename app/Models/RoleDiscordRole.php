<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class RoleDiscordRole extends Model
{
    public $timestamps = false;

    protected $fillable = ['role_id', 'discord_role_id'];

}
