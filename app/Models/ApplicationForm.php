<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    protected $fillable = ['corporation_id', 'name', 'description'];

    public function corporation()
    {
        return $this->belongsTo(Corporation::class);
    }
}
