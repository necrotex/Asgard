<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Skillpoints extends Model
{
    protected $table = 'character_skillpoints';
    protected $fillable = ['total_sp', 'unallocated_sp', 'character_id'];

    public $timestamps = false;
}
