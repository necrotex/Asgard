<?php

namespace Asgard\Models\Character;

use Asgard\Models\Eve\Type;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $timestamps = false;

    protected $table = 'character_assets';
    protected $appends = ['type_name'];

    protected $fillable = [
        'character_id',
        'location_flag',
        'location_id',
        'is_singleton',
        'type_id',
        'item_id',
        'location_type',
        'quantity',
        'name',
        'location_name'
    ];

    public function type()
    {
        return $this->hasOne(Type::class, 'typeID', 'type_id');
    }

    public function getTypeNameAttribute($value)
    {
        return $value->type->name;
    }

}
