<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Asgard\Models\Corporation;
use Illuminate\Database\Eloquent\Model;

class CorporationHistory extends Model
{
    protected $table = 'character_corporation_histories';
    protected $fillable = ['corporation_id', 'record_id', 'start_date', 'character_id', 'corporation_name'];

    public $timestamps = false;

    protected $casts = [
       'start_date' => 'datetime'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
