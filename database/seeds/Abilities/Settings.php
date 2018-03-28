<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class Settings extends Seeder
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
                'name' => 'view-settings',
                'title' => 'View Settings'
            ]
        );

        Ability::create(
            [
                'name' => 'edit-settings',
                'title' => 'Edit Settings'
            ]
        );

        Ability::create(
            [
                'name' => 'create-settings',
                'title' => 'Add Settings'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-settings',
                'title' => 'Delete Settings'
            ]
        );
    }
}
