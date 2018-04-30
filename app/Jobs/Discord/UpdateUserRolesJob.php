<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\User;
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
     * @return void
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

            $assigedRoles = $this->user->getDiscordRolesAsArray();

            $member = $discord->guild->getGuildMember(
                [
                    'user.id' => $this->user->discordAccount->id,
                    'guild.id' => config('services.discord.guild_id')
                ]
            );

            $remove = [];
            foreach ($member['roles'] as $memberRole) {
                if (!in_array($memberRole, $assigedRoles)) {
                    $remove[] = $memberRole;
                }
            }

            $add = [];
            foreach ($assigedRoles as $assigedRole) {
                if (!in_array($assigedRole, $member['roles'])) {
                    $add[] = $assigedRole;
                }
            }

            //remove not authorized roles
            foreach ($remove as $role) {
                $discord->guild->removeGuildMemberRole(
                    [
                        'user.id' => $this->user->discordAccount->id,
                        'guild.id' => config('services.discord.guild_id'),
                        'role.id' => $role
                    ]
                );
            }

            //add authorized roles
            foreach ($add as $role) {
                $response = $discord->guild->addGuildMemberRole(
                    [
                        'user.id' => $this->user->discordAccount->id,
                        'guild.id' => config('services.discord.guild_id'),
                        'role.id' => $role
                    ]
                );
            }

            //todo: logging
        }
    }
}
