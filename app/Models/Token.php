<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['token', 'expiry'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
