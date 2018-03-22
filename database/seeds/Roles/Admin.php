<?php

namespace Asgard\Seeds\Roles;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Role;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'title' => 'Admin']);
    }
}
