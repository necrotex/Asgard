<?php

namespace Asgard\Http\Controllers\Character;

use Asgard\Models\Character;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;

class JournalController extends Controller
{
    public function entries(Character $character)
    {
        return DataTables::of($character->journal())->make(true);
    }
}