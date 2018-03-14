<?php

use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Asgard\Models\ApplicationStatus::create(
            [
                'title' => 'In Progress',
                'slug' => 'in-progress',
            ],
            [
                'title' => 'Accepted',
                'slug' => 'accepted',
            ],
            [
                'title' => 'Denied',
                'slug' => 'denied',
            ],
            [
                'title' => 'On Hold',
                'slug' => 'on-hold',
            ]
        );
    }
}
