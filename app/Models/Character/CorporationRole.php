<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class CorporationRole extends Model
{
    protected $table = 'character_corporation_roles';

    protected $fillable = ['character_id', 'role'];
}
