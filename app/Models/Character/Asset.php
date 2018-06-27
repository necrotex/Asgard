<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Asgard\Models\Eve\Type;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'character_assets';
    protected static $unguarded = true;
    protected $primaryKey = 'item_id';
    protected $appends = ['type_name'];

    protected $casts = [
        'is_singleton' => 'boolean',
    ];


    public function character()
    {
        return $this->hasOne(Character::class);
    }

    public function type()
    {
        return $this->hasOne(Type::class, 'typeID', 'type_id');
    }

    public function getTypeNameAttribute($value)
    {
        return $value->type->name;
    }

}
