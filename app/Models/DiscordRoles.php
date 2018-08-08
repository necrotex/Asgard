<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class DiscordRoles extends Model
{
    protected $fillable = ['discord_id'];
    protected $casts = [
        'restricted' => 'boolean',
    ];
}
