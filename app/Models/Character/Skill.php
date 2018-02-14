<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'character_skills';
    protected $fillable = ['skill_id', 'character_id', 'skillpoints_in_skill', 'trained_skill_level', 'active_skill_level' ];

    public $timestamps = false;
}
