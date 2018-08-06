<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Models\User;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public function overview()
    {
        return view('dashboard.users');
    }

    public function table()
    {
        $users = User::with(['characters']);

        return DataTables::of($users)
            ->addColumn('name', function ($user) {
                if ($user->mainCharacter)
                    return $user->mainCharacter->name;
                else
                    return $user->name;
            })
            ->addColumn('route', function ($user) {
                return route('profile.show', $user);
            })
            ->filterColumn('name', function($query, $keyword) {
                $sql = "name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->make(true);
    }
}
