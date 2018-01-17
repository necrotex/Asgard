<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class RedditUser extends Model
{

    protected $fillable = ['reddit_id'];

    public function user() {
        $this->belongsTo(User::class);
    }
}
