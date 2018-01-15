<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Models\Corporation;
use Conduit\Conduit;
use Conduit\Exceptions\HttpStatusException;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class CorporationController extends Controller
{

    public function index()
    {
        $corporations = Corporation::all();

        return view('dashboard.corporation.index', ['corporations' => $corporations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        //98224068
        //dd($data->data);

        $corp = Corporation::firstOrNew(['id' => $request->input('corp_id')]);

        $this->dispatchNow(new \Asgard\Jobs\Update\Corporation($corp, $data));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
