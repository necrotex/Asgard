<?php

namespace Asgard\Http\Controllers;

use Asgard\Jobs\Discord\Rename;
use Asgard\Jobs\Discord\SyncUsers;
use Asgard\Jobs\Discord\UpdateUserRolesJob;
use Asgard\Models\Character;
use Asgard\Models\User;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index()
    {
        dispatch_now(new SyncUsers());
    }
}
