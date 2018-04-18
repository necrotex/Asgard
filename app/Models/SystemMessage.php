<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class SystemMessage extends Model
{
    protected $fillable = ['type','message','context_type','level','title','context_id','active'];
}
