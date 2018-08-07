<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Discord\Rename;
use Asgard\Jobs\Discord\UpdateUserRolesJob;
use Asgard\Models\Character;
use Asgard\Models\User;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index()
    {
        $char = User::find(1);
        dispatch_now(new Rename($char));
    }
}
