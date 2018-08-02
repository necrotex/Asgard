<?php

use Illuminate\Database\Seeder;

class HaikuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(file_exists(storage_path('seeds/haikus.json'))) {
            $haikus = json_decode(file_get_contents(storage_path('seeds/haikus.json')), true);

            \Asgard\Models\Haiku::insert($haikus);
        }
    }
}
