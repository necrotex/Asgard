<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\Database\Role;
use Silber\Bouncer\Database\Ability;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'title' => 'Admin']);
        Bouncer::allow('admin')->everything();
        Bouncer::allow('admin')->to('access-everything');

        Role::create(['name' => 'director', 'title' => 'Director']);
        Bouncer::allow('director')->to('use-search');
        Bouncer::allow('director')->to('see-profiles');
        Bouncer::allow('director')->to('view-characters');
        Bouncer::allow('director')->to('add-characters');
        Bouncer::allow('director')->to('view-mails');
        Bouncer::allow('director')->to('view-corporations');
        Bouncer::allow('director')->to('create-corporations');
        Bouncer::allow('director')->to('update-corporations');
        Bouncer::allow('director')->to('delete-corporations');
        Bouncer::allow('director')->to('view-roles');
        Bouncer::allow('director')->to('create-roles');
        Bouncer::allow('director')->to('update-roles');
        Bouncer::allow('director')->to('delete-roles');
        Bouncer::allow('director')->to('view-timer');
        Bouncer::allow('director')->to('create-timer');
        Bouncer::allow('director')->to('delete-timer');
        Bouncer::allow('director')->to('timer-override');
        Bouncer::allow('director')->to('access-subreddit');
        Bouncer::allow('director')->to('view-application-forms');
        Bouncer::allow('director')->to('create-application-forms');
        Bouncer::allow('director')->to('update-application-forms');
        Bouncer::allow('director')->to('view-application-form-questions');
        Bouncer::allow('director')->to('update-application-form-questions');
        Bouncer::allow('director')->to('create-application-form-questions');
        Bouncer::allow('director')->to('delete-application-form-questions');
        Bouncer::allow('director')->to('view-application-invite');
        Bouncer::allow('director')->to('update-application-invite');
        Bouncer::allow('director')->to('create-application-invite');
        Bouncer::allow('director')->to('delete-application-invite');
        Bouncer::allow('director')->to('view-application');
        Bouncer::allow('director')->to('update-application');
        Bouncer::allow('director')->to('create-application');
        Bouncer::allow('director')->to('delete-application');
        Bouncer::allow('director')->to('delete-application');


        Role::create(['name' => 'member', 'title' => 'Member']);
        Bouncer::allow('member')->to('add-characters');
        Bouncer::allow('member')->to('view-timer');
        Bouncer::allow('member')->to('create-timer');
        Bouncer::allow('member')->to('access-subreddit');


        Role::create(['name' => 'recruiter', 'title' => 'Recruiter']);
        Bouncer::allow('recruiter')->to('use-search');
        Bouncer::allow('recruiter')->to('see-profiles');
        Bouncer::allow('recruiter')->to('view-characters');
        Bouncer::allow('recruiter')->to('view-application-forms');
        Bouncer::allow('recruiter')->to('view-application-forms');
        Bouncer::allow('recruiter')->to('view-application-form-questions');
        Bouncer::allow('recruiter')->to('view-application-invite');
        Bouncer::allow('recruiter')->to('create-application-invite');
        Bouncer::allow('recruiter')->to('view-application');
        Bouncer::allow('recruiter')->to('update-application');


        Role::create(['name' => 'friends', 'title' => 'Friend']);
        Bouncer::allow('friends')->to('add-characters');
        Bouncer::allow('friends')->to('access-subreddit');


        Role::create(['name' => 'guest', 'title' => 'Guest']);
        Bouncer::allow('guest')->to('add-characters');


        Role::create(['name' => 'recruit', 'title' => 'Recruit']);
        Bouncer::allow('recruit')->to('add-characters');
        Bouncer::allow('recruit')->to('create-application');
    }
}
