<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class Characters extends Seeder
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
                'name' => 'view-characters',
                'title' => 'View Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'edit-settings',
                'title' => 'Edit Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'create-settings',
                'title' => 'Add Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-settings',
                'title' => 'Delete Characters'
            ]
        );
    }
}
