<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Asgard\Models\Corporation;
use Illuminate\Database\Eloquent\Model;

class CorporationHistory extends Model
{
    protected $table = 'character_corporation_histories';
    protected $fillable = ['corporation_id', 'record_id', 'start_date', 'character_id'];

    public $timestamps = false;

    protected $casts = [
       'start_date' => 'datetime'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function corporation()
    {
        return $this->hasOne(Corporation::class, 'id', 'corporation_id');
    }
}
