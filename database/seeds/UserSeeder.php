<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \Asgard\Models\User();
        $user->name = "Admin";
        $user->email = "necrotex@gmail.com";
        $user->password = bcrypt('test');
        $user->save();
    }
}
