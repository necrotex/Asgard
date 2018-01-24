<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\Concerns\HasRoles;

class Corporation extends Model
{

    use HasRoles;

    protected $fillable = ['id'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function sync()
    {

    }

}
