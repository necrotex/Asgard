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

    protected $discord;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->discord = new DiscordClient(['token' => config('services.discord.bot_token')]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = $this->discord->guild->getGuildRoles(['guild.id' => (int) config('services.discord.guild_id')]);

        //dd($response);

        foreach($response as $role) {
            if($role['name'] == "@everyone") continue; // skip @everyone

            $discordRole = DiscordRoles::firstOrNew(['discord_id' => $role['id']]);
            $discordRole->name = $role['name'];
            $discordRole->color = $role['color'];
            $discordRole->save();
        }


    }
}
