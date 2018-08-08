<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\User;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use RestCord\DiscordClient;

class Rename implements ShouldQueue
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
    public function handle(Conduit $api)
    {
        if(! $this->user->discordAccount) {
            return;
        }

        Redis::throttle(__CLASS__)->allow(20)->every(60)->then(function () use ($api) {

            $discord = new DiscordClient(
                [
                    'token' => config('services.discord.bot_token'),
                    'throwOnRatelimit' => true,
                    'logger' => app('log'),
                ]
            );

            // we need to get the corp ticker for corps that are not added to the system
            // todo: maybe we should just add unknown corps to the system when a character is added
            if (!$this->user->mainCharacter->corporation) {
                $corp = $api->corporations($this->user->mainCharacter->corporation_id)->get();
                $ticker = $corp->ticker;
            } else {
                $ticker = $this->user->mainCharacter->corporation->ticker;
            }

            $name = '[' . $ticker . '] ' . $this->user->mainCharacter->name;

            $response = $discord->guild->modifyGuildMember(
                [
                    'user.id' => $this->user->discordAccount->id,
                    'nick' => $name,
                    'guild.id' => config('services.discord.guild_id')
                ]
            );

        }, function () {
            return $this->release(10);
        });
    }
}
