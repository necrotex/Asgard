<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "character_contacts";
    protected $fillable = ['character_id', 'standing', 'contact_type', 'contact_id', 'name', 'label'];
}
