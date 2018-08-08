<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\DiscordRoles;
use Asgard\Models\DiscordUser;
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
     * @return void
     */
    public function handle()
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
            ->each(function ($member, $id) use ($unrestrictedRoles, $unauthedMembers, $authUsers, $discord) {

                // reject all roles form a user that are not unrestricted
                $roles = $member->get('roles')->values()->reject(function ($role) use ($unrestrictedRoles) {
                    return !$unrestrictedRoles->has($role);
                });

                // if the user has a discord account in auth merge his discord roles with the unrestricted roles and rename him
                if ($authUsers->has($id)) {
                    $roles = $roles->merge($authUsers->get($id)->user->getDiscordRoles()->keys())->unique();
                    Rename::dispatch($authUsers->get($id)->user)->onQueue('high');
                }

                UpdateRoles::dispatch($id, $roles->toArray())->onQueue('high');
            });
    }
}
