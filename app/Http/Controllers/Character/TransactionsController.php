<?php

namespace Asgard\Http\Controllers\Character;

use Asgard\Models\Character;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionsController extends Controller
{
    public function entries(Character $character)
    {
        return DataTables::of($character->transactions())->make(true);
    }
}
