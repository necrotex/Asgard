<?php

namespace Asgard\Policies;

use Asgard\Models\User;
use Asgard\Models\Character\Mail;
use Asgard\Support\SuperAdminPolicyTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class CharacterMailPolicy
{
    use HandlesAuthorization, SuperAdminPolicyTrait;

    public function access(User $user, Mail $mail) {
        $mailCharacterId = $mail->character_id;

        foreach($user->characters as $character) {
            if($mailCharacterId == $character->id) {
                return true;
            }
        }

        return false;
    }
}
