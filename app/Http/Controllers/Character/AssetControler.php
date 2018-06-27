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
        //@todo: this is not right, needs better filtering
        $assets = $character->assets()->with('type')->whereNotNull('location_name')->get();

        return DataTables::of($assets)
            ->addColumn('type_name', function ($asset) {
                return $asset->type->typeName;
            })
            ->addColumn('group', function ($asset) {
                return $asset->type->group->groupName;
            })
            ->addColumn('packaged', function ($asset) {
                return $asset->is_singleton ? 'Yes' : 'No';
            })
            ->addColumn('volume', function ($asset) {
                return number_format($asset->type->volume * $asset->quantity, 2) . 'm³';
            })
            ->toJson();
    }
}
