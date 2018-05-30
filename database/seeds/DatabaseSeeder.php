<?php

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
        $this->call(AbilitiesSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ApplicationStatusSeeder::class);
    }
}
