<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationFormQuestion extends Model
{
    protected $fillable = ['application_form_id', 'question','required','description','order'];

    public function form()
    {
        return $this->belongsTo(ApplicationForm::class, 'application_form_id', 'id');
    }
}
