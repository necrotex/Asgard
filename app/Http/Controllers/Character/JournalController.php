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
        return DataTables::of($character->journal())
            ->addColumn('other_party', function ($journal) use ($character) {
                $otherParty = '';

                switch ($journal) {
                    case !is_null($journal->first_party_id) && $journal->first_party_id != $character->id:
                        $otherParty = $journal->first_party_name;
                        break;
                    case !is_null($journal->second_party_id) && $journal->second_party_id != $character->id:
                        $otherParty = $journal->second_party_name;
                        break;
                }

                return $otherParty;
            })
            ->filterColumn('other_party', function($query, $keyword) {
                $sql = "first_party_name like ? or second_party_name like ?";
                $query->whereRaw($sql, ["%{$keyword}%", "%{$keyword}%"]);
            })
            ->make(true);
    }

    public function entry(Request $request, Character $character)
    {
        $entry = Character\Journal::where('character_id', $character->id)
            ->where('ref_id', $request->input('id'))
            ->firstOrFail();

        return view('dashboard.partials.modals.journal', ['entry' => $entry]);
    }
}