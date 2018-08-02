<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class Haiku extends Model
{
    protected static $unguarded = true;
    public $timestamps = false;

    protected $hidden = ['application_id', 'id'];
}
