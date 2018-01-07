<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

    protected $fillable = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function corporation()
    {
        return $this->belongsTo(Corporation::class);
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }
}
