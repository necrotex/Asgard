<?php

namespace Asgard\Models\Corporation;

use Asgard\Models\Character;
use Asgard\Models\Corporation;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'corporation_members';
    public $timestamps = false;
    public $incrementing = false;
    protected static $unguarded = true;


    public function corporation()
    {
        return $this->hasOne(Corporation::class);
    }

    public function character()
    {
        return $this->hasOne(Character::class, 'id', 'id');
    }
}
