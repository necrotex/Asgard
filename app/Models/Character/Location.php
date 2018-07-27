<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Asgard\Models\Eve\SolarSystem;
use Asgard\Models\Eve\Type;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'character_location';

    protected $fillable = ['character_id','ship_type_id','ship_name','solar_system_id','structure'];

    protected $with = ['solarSystem', 'shipType', 'character'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function solarSystem()
    {
        return $this->hasOne(SolarSystem::class, 'solarSystemID', 'solar_system_id');
    }

    public function shipType()
    {
        return $this->hasOne(Type::class, 'typeID', 'ship_type_id');
    }
}
