<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    protected $table = 'character_corporation';
    protected $fillable = ['id', 'name', 'ticker', 'character_id'];

}
