<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Role;
use Silber\Bouncer\Database\Ability;

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
        Role::create(['name' => 'friends', 'title' => 'Friend']);

        Role::create(['name' => 'recruiter', 'title' => 'Recruiter']);
        Role::create(['name' => 'recruitment-officer', 'title' => 'Recruitment Officer']);


        // Corporations
        Ability::create(
            [
                'name' => 'see-corporation',
                'title' => 'See Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'create-corporation',
                'title' => 'Add Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'update-corporation',
                'title' => 'Update Corporations'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-corporation',
                'title' => 'Remove Corporations'
            ]
        );


        //Roles
        Ability::create(
            [
                'name' => 'see-roles',
                'title' => 'See Roles'
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

        Ability::create(
            [
                'name' => 'assign-roles',
                'title' => 'Assign Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'assign-discord-roles',
                'title' => 'Assign Discord Roles'
            ]
        );

        Ability::create(
            [
                'name' => 'manage-subreddit-access',
                'title' => 'Manage Subreddit Access'
            ]
        );


        //Characters
        Ability::create(
            [
                'name' => 'add-characters',
                'title' => 'Add Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'update-characters',
                'title' => 'Update Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'delete-characters',
                'title' => 'Delete Characters'
            ]
        );


        //administrative stuff
        Ability::create(
            [
                'name' => 'manage-characters',
                'title' => 'Manage other Characters'
            ]
        );

        Ability::create(
            [
                'name' => 'manage-settings',
                'title' => 'Manage Auth Settings'
            ]
        );

        Ability::create(
            [
                'name' => 'see-audit-logs',
                'title' => 'See Audit Logs'
            ]
        );

        Ability::create(
            [
                'name' => 'access-everything',
                'title' => 'Access Everything (ADMIN ONLY!)'
            ]
        );

        Ability::create(
            [
                'name' => 'access-subreddit',
                'title' => 'Access Subreddit'
            ]
        );

        Ability::create(
            [
                'name' => 'access-discord',
                'title' => 'Access Discord'
            ]
        );

        Ability::create(
            [
                'name' => 'see-users',
                'title' => 'Access User Profiles'
            ]
        );


        // assign basic abilities

        Bouncer::allow('admin')->to('access-everything');

        Bouncer::allow('director')->to('see-corporation');
        Bouncer::allow('director')->to('create-corporation');
        Bouncer::allow('director')->to('update-corporation');
        Bouncer::allow('director')->to('delete-corporation');
        Bouncer::allow('director')->to('see-roles');
        Bouncer::allow('director')->to('create-roles');
        Bouncer::allow('director')->to('update-roles');
        Bouncer::allow('director')->to('delete-roles');
        Bouncer::allow('director')->to('assign-roles');
        Bouncer::allow('director')->to('assign-discord-roles');
        Bouncer::allow('director')->to('manage-subreddit-access');
        Bouncer::allow('director')->to('manage-characters');
        Bouncer::allow('director')->to('manage-settings');
        Bouncer::allow('director')->to('see-audit-logs');
        Bouncer::allow('director')->to('see-users');


        Bouncer::allow('member')->to('add-characters');
        Bouncer::allow('member')->to('update-characters');
        Bouncer::allow('member')->to('delete-characters');
        Bouncer::allow('member')->to('access-subreddit');
        Bouncer::allow('member')->to('access-discord');

        Bouncer::allow('ally')->to('access-discord');
        Bouncer::allow('ally')->to('add-characters');
        Bouncer::allow('ally')->to('update-characters');
        Bouncer::allow('ally')->to('delete-characters');

        Bouncer::allow('friends')->to('delete-characters');
        Bouncer::allow('friends')->to('add-characters');
        Bouncer::allow('friends')->to('access-discord');
        Bouncer::allow('friends')->to('update-characters');
        Bouncer::allow('friends')->to('delete-characters');
        Bouncer::allow('friends')->to('access-subreddit');


    }
}
