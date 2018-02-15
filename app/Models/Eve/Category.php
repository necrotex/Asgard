<?php

namespace Asgard\Models\Eve;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'invCategories';

    public function groups() {
        return $this->hasMany(Group::class, 'categoryID','categoryID');
    }
}
