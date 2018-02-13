<?php


namespace Asgard\Support;


use Asgard\Models\Character;
use Conduit\Authentication;

trait ConduitAuthTrait
{
    public function getAuthentication(Character $character)
    {
        return new Authentication(
            config('services.eveonline.client_id'),
            config('services.eveonline.client_secret'),
            $character->refresh_token);
    }
}