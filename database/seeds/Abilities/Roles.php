<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ability::create(
            [
                'name' => 'view-roles',
                'title' => 'View Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'edit-roles',
                'title' => 'Edit Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'create-roles',
                'title' => 'Add Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-roles',
                'title' => 'Delete Roles'
            ]
        );
    }
}
