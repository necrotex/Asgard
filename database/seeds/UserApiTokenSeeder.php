<?php

use Asgard\Models\User;
use Illuminate\Database\Seeder;

class UserApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $users->each(function($user){
            $user->api_token = str_random(60);
            $user->save();
        });
    }
}
