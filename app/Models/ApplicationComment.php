<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationComment extends Model
{
    protected $fillable = ['application_id','user_id','comment','system_message'];

    protected $casts = [
        'system_message' => 'boolean'
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
