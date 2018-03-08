<?php


namespace Asgard\Support;


use Asgard\Models\User;

trait SuperAdminPolicyTrait
{
    public function before(User $user) {
        if($user->can('access-everything')) {
            return true;
        }
    }
}