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
            ]
        );

        \Asgard\Models\ApplicationStatus::create(
            [
                'title' => 'Accepted',
                'slug' => 'accepted',
            ]
        );

        \Asgard\Models\ApplicationStatus::create(
            [
                'title' => 'Denied',
                'slug' => 'denied',
            ]
        );

        \Asgard\Models\ApplicationStatus::create(
            [
                'title' => 'On Hold',
                'slug' => 'on-hold',
            ]
        );
    }
}
