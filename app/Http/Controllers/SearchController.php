<?php

namespace Asgard\Http\Controllers;

use Asgard\Models\Character;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, $term = null)
    {

        $request->validate(['term' => 'required']);

        $result = Character::where('name', 'like', '%' . $term . '%')->get();

        if (count($result) == 1)
            return redirect()->route('profile.show', $result[0]->user->id);

        return view('dashboard.search', ['results' => $result, 'term' => $term]);

    }
}
