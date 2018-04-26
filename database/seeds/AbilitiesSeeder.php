<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Ability;

class AbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Misc
        Ability::create(
            [
                'name' => 'access-everything',
                'title' => '!! Super admin ability, use with extreme care !!'
            ]
        );

        Ability::create(
            [
                'name' => 'use-search',
                'title' => 'Use Character search'
            ]
        );

        Ability::create(
            [
                'name' => 'see-profiles',
                'title' => 'See User Profiles'
            ]
        );

        Ability::create(
            [
                'name' => 'view-admin-settings',
                'title' => 'View Admin Settings'
            ]
        );

        Ability::create(
            [
                'name' => 'view-job-monitoring',
                'title' => 'Access Job Monitoring'
            ]
        );

        // Character
        Ability::create(
            [
                'name' => 'view-characters',
                'title' => 'View own Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'add-characters',
                'title' => 'Add Characters'
            ]
        );

        // Character Mails
        Ability::create(
            [
                'name' => 'view-mails',
                'title' => 'View Mails'
            ]
        );



        // Corporations
        Ability::create(
            [
                'name' => 'view-corporations',
                'title' => 'View Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'create-corporations',
                'title' => 'Add Corporation'
            ]
        );

        Ability::create(
            [
                'name' => 'update-corporations',
                'title' => 'Update Corporation'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-corporations',
                'title' => 'Add Corporation'
            ]
        );


        // Roles
        Ability::create(
            [
                'name' => 'view-roles',
                'title' => 'View Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'create-roles',
                'title' => 'Add Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'update-roles',
                'title' => 'Update Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-roles',
                'title' => 'Delete Roles'
            ]
        );

        //Timerboard
        Ability::create(
            [
                'name' => 'view-timer',
                'title' => 'View Timerboard'
            ]
        );

        Ability::create(
            [
                'name' => 'create-timer',
                'title' => 'Create Timer'
            ]
        );

        Ability::create(
            [
                'name' => 'update-timer',
                'title' => 'Update Timer'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-timer',
                'title' => 'Delete Timer'
            ]
        );

        Ability::create(
            [
                'name' => 'timer-override',
                'title' => 'Timerboard override'
            ]
        );

        // Services
        Ability::create(
            [
                'name' => 'access-subreddit',
                'title' => 'Access Subreddit'
            ]
        );

        // Application Forms

        Ability::create(
            [
                'name' => 'view-application-forms',
                'title' => 'View Application Forms'
            ]
        );

        Ability::create(
            [
                'name' => 'create-application-forms',
                'title' => 'Create Application Forms'
            ]
        );

        Ability::create(
            [
                'name' => 'update-application-forms',
                'title' => 'Update Application Forms'
            ]
        );

        // Application form questions

        Ability::create(
            [
                'name' => 'view-application-form-questions',
                'title' => 'View Application Form Questions'
            ]
        );

        Ability::create(
            [
                'name' => 'update-application-form-questions',
                'title' => 'Update Application Form Questions'
            ]
        );

        Ability::create(
            [
                'name' => 'create-application-form-questions',
                'title' => 'Create Application Form Questions'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-application-form-questions',
                'title' => 'Delete Application Form Questions'
            ]
        );

        // Application Invite

        Ability::create(
            [
                'name' => 'view-application-invite',
                'title' => 'View Application Invite'
            ]
        );

        Ability::create(
            [
                'name' => 'update-application-invite',
                'title' => 'Update Application Invite'
            ]
        );

        Ability::create(
            [
                'name' => 'create-application-invite',
                'title' => 'Create Application Invite'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-application-invite',
                'title' => 'Delete Application Invite'
            ]
        );

        // Applications

        Ability::create(
            [
                'name' => 'view-application',
                'title' => 'View Application'
            ]
        );

        Ability::create(
            [
                'name' => 'update-application',
                'title' => 'Update Application'
            ]
        );

        Ability::create(
            [
                'name' => 'create-application',
                'title' => 'Create Application'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-application',
                'title' => 'Delete Application'
            ]
        );


    }
}
