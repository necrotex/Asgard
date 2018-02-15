<?php

namespace Asgard\Models\Eve;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'invTypes';

    public function group()
    {
        return $this->belongsTo(Group::class, 'groupID', 'groupID');
    }

}
