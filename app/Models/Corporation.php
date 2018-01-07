<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function sync()
    {

    }
}
