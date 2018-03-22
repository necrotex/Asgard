<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class ApplicationForms extends Seeder
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
                'name' => 'view-application-forms',
                'title' => 'View Application Forms'
            ]
        );

        Ability::create(
            [
                'name' => 'edit-application-forms',
                'title' => 'Edit Application Forms'
            ]
        );

        Ability::create(
            [
                'name' => 'create-application-forms',
                'title' => 'Add Application Forms'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-application-forms',
                'title' => 'Delete Application Forms'
            ]
        );
    }
}
