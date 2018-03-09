<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Models\Corporation;
use Asgard\Models\Setting;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('index', Setting::class);

        $corporations = Corporation::all();

        return view('dashboard.admin.index', ['corporations' => $corporations]);
    }
}
