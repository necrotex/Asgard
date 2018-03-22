<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class Abilities extends Seeder
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
                'name' => 'view-abilities',
                'title' => 'View Abilities'
            ]
        );

        Ability::create(
            [
                'name' => 'edit-abilities',
                'title' => 'Edit Abilities'
            ]
        );

        Ability::create(
            [
                'name' => 'create-abilities',
                'title' => 'Add Abilities'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-abilities',
                'title' => 'Delete Abilities'
            ]
        );
    }
}
