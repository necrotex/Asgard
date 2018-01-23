<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Role;

class RoleAndAbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'title' => 'Admin']);
        Role::create(['name' => 'director', 'title' => 'Director']);
        Role::create(['name' => 'member', 'title' => 'Member']);
        Role::create(['name' => 'ally', 'title' => 'Ally']);
        Role::create(['name' => 'friend', 'title' => 'Friend']);
    }
}
