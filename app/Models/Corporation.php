<?php

namespace Asgard\Models;

use Asgard\Models\Corporation\Members;
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

    public function ceo()
    {
        return $this->hasOne(Character::class, 'id', 'ceo_id');
    }

    public function members()
    {
        return $this->hasMany(Members::class);
    }

}
