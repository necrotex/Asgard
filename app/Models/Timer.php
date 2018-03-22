<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Timer extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'ownerId')->first();
    }

    public function forGroup()
    {
        //todo make function to return group names for those that can see it.
        if ($this->forGroup == null)
            return null;
        else
            return DB::table('roles')->where('id', $this->forGroup)->first();
    }
}
