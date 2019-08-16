<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Http\Controllers\Controller;
use Asgard\Models\DiscordChannel;
use Asgard\Models\DiscordRoles;
use Asgard\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discord_channels = DiscordChannel::whereActive(true)->get();
        $discord_roles = DiscordRoles::all();

        return view('dashboard.settings', compact('discord_channels', 'discord_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->has('recruitment-notification-channel')) {
            $channel = $request->input('recruitment-notification-channel');
            Setting::set('notification.recruitment', $channel);
        }

        $restrictedRoles = $request->input('unrestricted-discord-roles');
        $roles = DiscordRoles::all();
        $roles->each(function ($role) use ($restrictedRoles) {
            if (!is_null($restrictedRoles) && in_array($role->id, $restrictedRoles)) {
                $role->restricted = false;
            } else {
                $role->restricted = true;
            }

            $role->save();
        });


        flash()->success('Successfully saved');

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
}
