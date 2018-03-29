<?php

namespace Asgard;

use Illuminate\Database\Eloquent\Model;

class ApplicationInvite extends Model
{
    protected $fillable = ['code', 'application_form_id', 'expiry', 'user_id'];
}
