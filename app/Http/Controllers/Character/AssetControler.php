<?php

namespace Asgard\Http\Controllers\Character;

use Asgard\Models\Character;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AssetControler extends Controller
{
    public function entries(Character $character)
    {
        $assets = Character\Asset::with('type')
            ->where('character_id', '=', $character->id)
            ->whereNull('related_asset')
            ->get();

        dd($assets);

        return DataTables::of($assets)->make(true);
    }
}
