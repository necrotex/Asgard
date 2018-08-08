<?php

namespace Asgard\Jobs\Discord;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use RestCord\DiscordClient;

class UpdateRoles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $discord_id;
    /**
     * @var array
     */
    public $roles;

    /**
     * Create a new job instance.
     *
     * @param $discord_id
     * @param array $roles
     */
    public function __construct($discord_id, array $roles)
    {
        $this->discord_id = $discord_id;
        $this->roles = $roles;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle(__CLASS__)->allow(20)->every(60)->then(function () {

            $discord = new DiscordClient(
                [
                    'token' => config('services.discord.bot_token'),
                    'throwOnRatelimit' => true,
                    'logger' => app('log'),
                ]
            );

            $discord->guild->modifyGuildMember(
                [
                    'guild.id' => config('services.discord.guild_id'),
                    'user.id' => $this->discord_id,
                    'roles' => $this->roles
                ]
            );

        }, function () {
            return $this->release(10);
        });

    }
}
