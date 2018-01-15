<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Models\Corporation;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $corporations = Corporation::all();

        return view('dashboard.admin.index', ['corporations' => $corporations]);
    }
}
