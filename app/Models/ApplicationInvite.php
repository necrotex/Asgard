<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationInvite extends Model
{
    protected $fillable = ['code', 'application_form_id', 'expiry', 'user_id'];

    protected $casts = ['expiry' => 'datetime'];

    public function applicationForm()
    {
        return $this->belongsTo(ApplicationForm::class, 'application_form_id', 'id');
    }
}
