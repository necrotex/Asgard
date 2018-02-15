<?php

namespace Asgard\Models\Character;

use Asgard\Models\Eve\Group;
use Asgard\Models\Eve\Type;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'character_skills';
    protected $fillable = ['skill_id', 'character_id', 'skillpoints_in_skill', 'trained_skill_level', 'active_skill_level' ];

    public $timestamps = false;

    public function type()
    {
        return $this->hasOne(Type::class, 'typeID', 'skill_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'typeID', 'skill_id');
    }

    public function scopeByGroup($query, $groupID) {
        return $query->join('invTypes', 'skill_id', '=', 'invTypes.typeID')
            ->join('invGroups', 'invTypes.groupID', '=', 'invGroups.groupID')
            ->where('invGroups.groupID', '=', $groupID);
    }
}
