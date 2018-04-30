<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\DiscordRoles;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use RestCord\DiscordClient;

class FetchRoles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $discord = new DiscordClient(['token' => config('services.discord.bot_token')]);
        $response = $discord->guild->getGuildRoles(['guild.id' => (int)config('services.discord.guild_id')]);

        foreach ($response as $role) {
            // skip @everyone
            if ($role->name == "@everyone") {
                continue;
            }

            $discordRole = DiscordRoles::firstOrNew(['discord_id' => $role->id]);
            $discordRole->name = $role->name;
            $discordRole->color = $role->color;
            $discordRole->save();
        }
    }
}
