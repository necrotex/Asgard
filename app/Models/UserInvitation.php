<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    protected $fillable = ['invite_id', 'user_id', 'completed'];
    protected $casts = ['completed' => 'boolean'];

    public function invite()
    {
        return $this->hasOne(ApplicationInvite::class, 'id', 'invite_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
