<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\DiscordRoles;
use Asgard\Models\DiscordUser;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use RestCord\DiscordClient;

class SyncUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        $discord = new DiscordClient(
            [
                'token' => config('services.discord.bot_token'),
                'throwOnRatelimit' => true,
                'logger' => app('log'),
            ]
        );

        $members = $discord->guild->listGuildMembers(
            [
                'guild.id' => config('services.discord.guild_id'),
                'limit' => 999,
            ]
        );

        $members = collect($members)->recursive()->keyBy('user.id');
        $authUsers = DiscordUser::whereIn('id', $members->keys()->toArray())->get()->keyBy('id');
        $unrestrictedRoles = DiscordRoles::whereRestricted(false)->get()->keyBy('discord_id');

        $unauthedMembers = $members->diffKeys($authUsers);

        $members
            ->reject(function ($member) {
                // don't touch bots
                return $member->get('user')->get('bot');
            })
            ->each(function ($member, $id) use ($unrestrictedRoles, $unauthedMembers, $authUsers, $discord, $api) {

                // reject all roles form a user that are not unrestricted
                $roles = $member->get('roles')->values()->reject(function ($role) use ($unrestrictedRoles) {
                    return !$unrestrictedRoles->has($role);
                });

                // if the user has a discord account in auth merge his discord roles with the unrestricted roles and rename him
                if ($authUsers->has($id)) {
                    $user = $authUsers->get($id)->user;

                    $roles = $roles->merge($user->getDiscordRoles()->keys())->unique();

                    if (!$user->mainCharacter->corporation) {
                        $corp = $api->corporations($user->mainCharacter->corporation_id)->get();
                        $ticker = $corp->ticker;
                    } else {
                        $ticker = $user->mainCharacter->corporation->ticker;
                    }

                    $name = '[' . $ticker . '] ' . $user->mainCharacter->name;

                    ModifyGuildMember::dispatch($id, $name, $roles->toArray())->onQueue('high');
                } else {
                    ModifyGuildMember::dispatch($id, null, $roles->toArray())->onQueue('high');
                }
            });
    }
}
