<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Http\Controllers\Controller;
use Asgard\Models\Character;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $request->validate(['term' => 'required']);
        $term = $request->input('term');

        $result = Character::where('name', 'like', '%' . $term . '%')->get();

        if ($result->count() == 1)
            return redirect()->route('profile.show', $result->first()->user->id);

        return view('dashboard.search', ['results' => $result, 'term' => $term]);

    }
}
