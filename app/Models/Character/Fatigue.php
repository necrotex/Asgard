<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Fatigue extends Model
{
    protected $table = 'character_fatigue';

    protected $fillable = ['last_jump_date', 'jump_fatigue_expire_date', 'last_update_date', 'character_id'];

}
