<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationFormQuestionAnswer extends Model
{
    protected $fillable = [
        'application_id',
        'question_id',
        'question',
        'answer',
        'version',
    ];
}
