<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'character_journals';
    protected $primaryKey = 'id';
    protected static $unguarded = true;

    public function character() {
        return $this->belongsTo(Character::class);
    }

    public function getRefTypeAttribute($ref_type)
    {
        return title_case(implode(' ', explode('_', $ref_type)));
    }

    public function getBalanceAttribute($balance)
    {
        return number_format($balance, 2);
    }

    public function getAmountAttribute($amount)
    {
        return number_format($amount, 2);
    }

}
