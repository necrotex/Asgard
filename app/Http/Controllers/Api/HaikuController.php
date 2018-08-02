<?php

namespace Asgard\Http\Controllers\Api;

use Asgard\Http\Controllers\Controller;
use Asgard\Http\Resources\HaikuResource;
use Asgard\Models\Haiku;
use Illuminate\Http\Request;

class HaikuController extends Controller
{
    public function random()
    {
        $haiku = Haiku::inRandomOrder()->first();

        return new HaikuResource($haiku);
    }

    public function find($name)
    {
        $name = urldecode($name);
        $haiku = Haiku::where('author', 'like', "%$name%")->inRandomOrder()->first();

        if (is_null($haiku)) {
            return response()->json()->setStatusCode(404);
        }

        return new HaikuResource($haiku);
    }
}
