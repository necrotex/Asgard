<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\DiscordRoles;
use Asgard\Models\User;
use function foo\func;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use RestCord\DiscordClient;

class UpdateUserRolesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if ($this->user->discordAccount) {
            $discord = new DiscordClient(['token' => config('services.discord.bot_token')]);

            $assigedRoles = $this->user->getDiscordRoles();
            $unrestrictedRoles = DiscordRoles::whereRestricted(false)->get()->keyBy('discord_id');

            $response = $discord->guild->getGuildMember(
                [
                    'user.id' => $this->user->discordAccount->id,
                    'guild.id' => config('services.discord.guild_id')
                ]
            );

            $member = collect($response)->recursive();

            // remove roles that are restricted and not assigned
            $member->get('roles')->reject(function ($role) use ($assigedRoles, $unrestrictedRoles) {
                if ($assigedRoles->has($role) || $unrestrictedRoles->has($role))
                    return true;
            })->each(function ($role) use ($discord) {
                $discord->guild->removeGuildMemberRole(
                    [
                        'user.id' => $this->user->discordAccount->id,
                        'guild.id' => config('services.discord.guild_id'),
                        'role.id' => $role
                    ]
                );
            });

            // asign roles that are not already granted
            $assigedRoles->each(function ($role) use ($member, $discord) {
                if(!$member->get('roles')->contains($role->discord_id)) {
                    $discord->guild->addGuildMemberRole(
                        [
                            'user.id' => $this->user->discordAccount->id,
                            'guild.id' => config('services.discord.guild_id'),
                            'role.id' => $role->discord_id
                        ]
                    );
                }
            });

            //todo: logging
        }
    }
}
