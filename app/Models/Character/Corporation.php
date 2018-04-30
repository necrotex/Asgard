<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    protected $table = 'character_corporation';
    protected $fillable = ['corporation_id', 'name', 'ticker', 'character_id'];

}
