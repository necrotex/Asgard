<?php

namespace Asgard\Http\Controllers\Admin;

use Asgard\Models\DiscordRoles;
use Asgard\Models\RoleDiscordRole;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Bouncer;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('see-roles', Role::class);

        $roles = Role::all();

        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', Role::class);

        $request->validate(['role' => 'required']);

        $name = $request->input('role');
        $slug = str_slug($name);

        Role::create(['name' => $slug, 'title' => $name]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $discordRoles = DiscordRoles::all();
        $roleDiscordRoles = RoleDiscordRole::select('discord_role_id')->where('role_id', '=', $role->id)->get();

        $arrayDiscordRoles = [];
        foreach ($roleDiscordRoles as $rdr) {
            $arrayDiscordRoles[] = $rdr->discord_role_id;
        }

        $owedAbilityIds = [];
        foreach($role->abilities as $ability) {
            $owedAbilityIds[] = $ability->id;
        }

        $abilities = Ability::whereNotIn('id', $owedAbilityIds)->get();

        return view('dashboard.roles.edit',
            [
                'role' => $role,
                'discordRoles' => $discordRoles,
                'roleDiscordRoles' => $arrayDiscordRoles,
                'abilities' => $abilities
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $this->authorize('update', $role);

        $this->validate($request, ['title' => 'required']);

        $title = $request->input('title');
        $slug  = str_slug($title);

        $role->title = $title;
        $role->name = $slug;
        $role->save();

        //clean up
        RoleDiscordRole::where('role_id', '=', $role->id)->delete();

        if($request->has('discordRoles')) {
            $discordRoles =  $request->input('discordRoles');
            foreach($discordRoles as $discordRole) {
               RoleDiscordRole::create(['role_id' => $role->id, 'discord_role_id' => $discordRole]);
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        //todo: this needs to cascade correctly
        RoleDiscordRole::where('role_id', '=', $role->id)->delete();
        $role->delete();

        return redirect()->route('roles.index');
    }
}
