<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Asgard\Models\Eve\Type;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'character_transactions';
    protected $primaryKey = 'id';
    protected static $unguarded = true;

    protected $dates = [
        'date'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function journal()
    {
        $this->hasOne(Journal::class, 'ref_id', 'journal_ref_id');
    }


    public function type()
    {
        return $this->hasOne(Type::class, 'typeId', 'type_id');
    }


    public function getUnitPriceAttribute($price)
    {
        return number_format($price, 2);
    }

    public function getQuantityAttribute($quantity)
    {
        return number_format($quantity, 0);
    }

    public function getTotalAttribute()
    {
        return number_format($this->getOriginal('unit_price') * $this->getOriginal('quantity'), 2);
    }
}
