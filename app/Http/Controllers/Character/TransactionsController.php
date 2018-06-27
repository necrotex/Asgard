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
        $transactions = $character->transactions();
        return DataTables::of($transactions)
            ->addColumn('type_name', function ($transaction) {
                return $transaction->type->typeName;
            })
            ->addColumn('group_name', function ($transaction) {
                return $transaction->type->group->groupName;
            })
            ->addColumn('action_type', function ($transaction) {
                return $transaction->is_buy ? 'Buy' : 'Sell';
            })
            ->addColumn('total_price', function ($transaction) {
                return $transaction->total;
            })
            ->addColumn('ref_id', function ($transaction) {
                return $transaction->journal_ref_id;
            })


            ->make(true);
    }
}
