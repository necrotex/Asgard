<?php

namespace Asgard\Models\Eve;

use Asgard\Models\Character\Skill;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'invGroups';

    public function types()
    {
        return $this->hasMany(Type::class, 'groupID', 'groupID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'categoryID');
    }

}
