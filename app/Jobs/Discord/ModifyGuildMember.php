<?php

namespace Asgard\Jobs\Discord;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use RestCord\DiscordClient;

class ModifyGuildMember implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $discordUserId;
    /**
     * @var string
     */
    public $name;
    /**
     * @var array
     */
    public $roles;

    /**
     * Create a new job instance.
     *
     * @param $discordUserId
     * @param string $name
     * @param array $roles
     */
    public function __construct($discordUserId, ?string $name = null, ?array $roles = null)
    {
        $this->discordUserId = $discordUserId;
        $this->name = $name;
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

            $payload = [
                'guild.id' => config('services.discord.guild_id'),
                'user.id' => $this->discordUserId,
            ];

            if (!is_null($this->name)) {
                $payload['nick'] = $this->name;
            }

            if (!is_null($this->roles)) {
                $payload['roles'] = $this->roles;
            }

            try {
                $discord->guild->modifyGuildMember($payload);
            } catch (\Exception $e) {
                \Log::debug("Could not modify discord user {$this->discordUserId}");
            }


        }, function () {
            return $this->release(10);
        });

    }
}
