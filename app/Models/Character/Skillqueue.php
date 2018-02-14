<?php

namespace Asgard\Models\Character;

use Asgard\Models\Eve\Type;
use Illuminate\Database\Eloquent\Model;

class Skillqueue extends Model
{
    protected $table = 'character_skillqueue';

    protected $fillable = [
        'skill_id',
        'finish_date',
        'start_date',
        'finished_level',
        'queue_position',
        'training_start_sp',
        'level_end_sp',
        'level_start_sp',
        'character_id'];

    public $timestamps = false;

    public function type()
    {
        return $this->hasOne(Type::class, 'typeID', 'skill_id');
    }
}
