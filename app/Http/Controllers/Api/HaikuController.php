<?php

namespace Asgard\Http\Controllers\Api;

use Asgard\Http\Controllers\Controller;
use Asgard\Models\Haiku;
use Illuminate\Http\Request;

class HaikuController extends Controller
{
    public function random()
    {
        $haiku = Haiku::inRandomOrder()->first();
    }
}
