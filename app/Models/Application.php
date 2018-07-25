<?php

namespace Asgard\Models;

use Asgard\Support\Hashidable;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use Hashidable;

    protected $fillable = ['user_id', 'status_id'];
    protected $with = ['status', 'applicant'];

    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status()
    {
        return $this->hasOne(ApplicationStatus::class, 'id', 'status_id');
    }

    public function comments()
    {
        return $this->hasMany(ApplicationComment::class, 'application_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(ApplicationFormQuestionAnswer::class, 'application_id', 'id');
    }

    public function invite()
    {
        return $this->hasOne(UserInvitation::class, 'application_id', 'id');
    }
}
