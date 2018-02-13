<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'character_status';
    protected $fillable = ['character_id', 'online', 'last_login', 'last_logout', 'logins'];

    protected $casts = [
        'online' => 'boolean',
        'last_logout' => 'datetime',
        'last_login' => 'datetime',
    ];
}
