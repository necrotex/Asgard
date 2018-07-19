<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Models\Character;
use Asgard\Models\Corporation;
use Conduit\Conduit;
use Conduit\Exceptions\HttpStatusException;
use DataTables;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Bouncer;
use Silber\Bouncer\Database\Role;


class CorporationController extends Controller
{

    public function index()
    {
        $corporations = Corporation::paginate(15);

        return view('dashboard.corporation.index', ['corporations' => $corporations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Conduit $api)
    {

        $this->validate($request, [
            'corp_id' => 'digits:8|required'
        ]);

        try {
            $data = $api->corporations($request->input('corp_id'))->get();
        } catch (HttpStatusException $e) { //todo: better work on status codes etc
            return back()->withErrors(['corp_id' => 'No Corporation found.']);
        }

        $this->dispatchNow(new \Asgard\Jobs\Update\Corporation($request->input('corp_id'), $data));

        $corp = Corporation::find($request->input('corp_id'));
        $corp->active = true;
        $corp->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param Corporation $corporation
     * @return \Illuminate\Http\Response
     */
    public function show(Corporation $corporation)
    {
        $corporation->load('roles');

        $roles = Role::all();

        $defaultRoles = [];
        foreach ($corporation->roles as $dr) {
            $defaultRoles[] = $dr->id;
        }

        return view('dashboard.corporation.show',
            ['corporation' => $corporation, 'roles' => $roles, 'defaultRoles' => $defaultRoles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Corporation $corporation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corporation $corporation)
    {
        foreach ($corporation->roles as $role) {
            Bouncer::retract($role)->from($corporation);
        }

        if (count($request->input('defaultRoles')) > 0) {
            $corporation->assign($request->input('defaultRoles'));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Corporation $corporation
     * @return
     * @throws \Exception
     */
    public function activeMembers(Corporation $corporation)
    {

        $members = $corporation->members()->has('character');

        return DataTables::of($members)
            ->addColumn('route', function ($member) {
                return route('characters.show', $member->character);
            })
            ->make(true);
    }

    public function missingMembers(Corporation $corporation)
    {
        $members = $corporation->members()->doesntHave('character');

        return DataTables::of($members)
            ->make(true);
    }
}
