<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\Concerns\HasRoles;

class Corporation extends Model
{
    use HasRoles;

    public $incrementing = false;
    protected $fillable = ['id'];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

}
