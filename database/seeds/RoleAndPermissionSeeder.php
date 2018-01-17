<?php

use Illuminate\Database\Seeder;
use \Silber\Bouncer\BouncerFacade as Bouncer;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('director')->to('create-corporation');
        Bouncer::allow('director')->to('update-corporation');
        Bouncer::allow('director')->to('delete-corporation');

        Bouncer::allow('director')->to('create-abilities');
        Bouncer::allow('director')->to('update-abilities');
        Bouncer::allow('director')->to('delete-abilities');

        Bouncer::allow('director')->to('create-characters');
        Bouncer::allow('director')->to('update-characters');
        Bouncer::allow('director')->to('delete-characters');
        Bouncer::allow('director')->to('see-all-characters');

        Bouncer::allow('member')->to('create-characters');
        Bouncer::allow('member')->to('update-characters');
        Bouncer::allow('member')->to('delete-characters');
    }
}
