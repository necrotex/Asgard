<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\DiscordRoles;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use RestCord\DiscordClient;

class UpdateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
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


        $name = null;

        if ($this->user->mainCharacter) {
            if (!$this->user->mainCharacter->corporation) {
                $corp = $api->corporations($this->user->mainCharacter->corporation_id)->get();
                $ticker = $corp->ticker;
            } else {
                $ticker = $this->user->mainCharacter->corporation->ticker;
            }

            $name = '[' . $ticker . '] ' . $this->user->mainCharacter->name;
        }

        ModifyGuildMember::dispatch($this->user->discordAccount->id, $name, $roles->toArray())->onQueue('high');
    }
}
