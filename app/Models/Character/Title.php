<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'character_titles';

    protected $fillable = ['character_id', 'title_id', 'name'];
}
