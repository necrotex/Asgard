<?php

namespace Asgard\Http\Controllers\User;

use Asgard\Models\DiscordRoles;
use Asgard\Models\RoleDiscordRole;
use Asgard\Models\User;
use Asgard\Models\UserDiscordRoles;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Bouncer;
use Silber\Bouncer\Database\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('dashboard.profile', ['user' => $user]);
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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $roles = Role::all();

        $userRoles = [];
        foreach ($user->roles as $userRole) {
            $userRoles[] = $userRole->id;
        }

        return view('dashboard.profile', ['user' => $user, 'roles' => $roles, 'userRoles' => $userRoles]);
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
    public function update(Request $request, User $user)
    {

        if ($request->has('mainCharacter')) {
            $this->validate($request, [
                'mainCharacter' => 'integer|required'
            ]);

            $user->main_character = $request->input('mainCharacter');
            $user->save();
        }


        if ($request->has('roleSubmit')) {
            UserDiscordRoles::where('user_id', '=', $user->id)->delete();


            if ($request->has('discordRoles')) {
                $discordRoles = $request->input('discordRoles');

                foreach ($discordRoles as $discordRole) {
                    UserDiscordRoles::create(['user_id' => $user->id, 'discord_role_id' => $discordRole]);
                }
            }

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
}
