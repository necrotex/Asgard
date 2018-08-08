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
use Illuminate\Support\Facades\Redis;
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

        if (!$this->user->discordAccount) {
            return;
        }

        $discord = new DiscordClient(
            [
                'token' => config('services.discord.bot_token'),
                'throwOnRatelimit' => true,
                'logger' => app('log'),
            ]
        );
        
        $assigedRoles = $this->user->getDiscordRoles();
        $unrestrictedRoles = DiscordRoles::whereRestricted(false)->get()->keyBy('discord_id');

        $response = $discord->guild->getGuildMember(
            [
                'user.id' => $this->user->discordAccount->id,
                'guild.id' => config('services.discord.guild_id')
            ]
        );

        $member = collect($response)->recursive();

        $roles = $member
            ->get('roles')->reject(function ($role) use ($assigedRoles, $unrestrictedRoles) {
                return !$assigedRoles->has($role) && !$unrestrictedRoles->has($role);
            })
            ->merge($assigedRoles->keys())
            ->unique();

        dispatch(new UpdateRoles($this->user->discordAccount->id, $roles->toArray()))->onQueue('high');
    }
}
