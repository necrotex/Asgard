<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
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
}
