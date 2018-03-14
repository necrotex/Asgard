<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id', 'form', 'status_id'];

    public function applicant()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->hasOne(ApplicationStatus::class, 'id', 'status_id');
    }

    public function comments()
    {
        return $this->hasMany(ApplicationComment::class, 'application_id');
    }
}
