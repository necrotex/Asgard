<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class Corporations extends Seeder
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
                'name' => 'view-corporations',
                'title' => 'View Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'edit-corporations',
                'title' => 'Edit Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'create-corporations',
                'title' => 'Add Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-corporations',
                'title' => 'Delete Corporations'
            ]
        );
    }
}
