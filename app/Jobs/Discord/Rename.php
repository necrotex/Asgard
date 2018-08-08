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
        //todo: logging

        if($this->user->discordAccount) {

            $user = $this->user;

            Redis::throttle('discord_rename')->allow(10)->every(60)->then(function () use ($user) {
                $discord = new DiscordClient(['token' => config('services.discord.bot_token')]);

                // we need to get the corp ticker for corps that are not added to the system
                // todo: maybe we should just add unknown corps to the system when a character is added
                if(!$user->mainCharacter->corporation) {
                    $corp = $api->corporations($user->mainCharacter->corporation_id)->get();
                    $ticker = $corp->ticker;
                } else {
                    $ticker = $user->mainCharacter->corporation->ticker;
                }

                $name = '['. $ticker .'] ' . $user->mainCharacter->name;

                $response = $discord->guild->modifyGuildMember(
                    [
                        'user.id' => $user->discordAccount->id,
                        'nick' => $name,
                        'guild.id' => config('services.discord.guild_id')
                    ]
                );
            }, function () {
                return $this->release(5);
            });

            //todo: check response etc
        }

    }
}
