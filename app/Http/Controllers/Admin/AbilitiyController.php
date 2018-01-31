<?php

namespace Asgard\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

class AbilitiyController extends Controller
{


    /**
     * Remove the specified resource from storage.
     *
     * @param Ability $ability
     * @return void
     */
    public function destroy(Ability $ability)
    {
        //
    }

    public function assign(Role $role, Request $request)
    {
        dd($role, $request->all());
    }
}
