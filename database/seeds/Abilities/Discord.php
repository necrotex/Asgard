<?php

namespace Asgard\Seeds\Abilities;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class Discord extends Seeder
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
                'name' => 'access-discord',
                'title' => 'Access Discord'
            ]
        );

    }
}
