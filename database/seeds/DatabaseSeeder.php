<?php

use Asgard\Seeds\Abilities\Settings;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //todo: remove this after development
        $this->call(RoleAndAbilitiesSeeder::class);
        $this->call(UserSeeder::class);

        //Abilities
        //$this->call(Settings::class);
    }
}
