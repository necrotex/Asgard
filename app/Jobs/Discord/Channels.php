<?php

namespace Asgard\Jobs\Discord;

use Asgard\Models\DiscordChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use RestCord\DiscordClient;

class Channels implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $discord = new DiscordClient(['token' => config('services.discord.bot_token')]);
        $response = $discord->guild->getGuildChannels(['guild.id' => (int)config('services.discord.guild_id')]);

        $channels = collect($response)->recursive()->keyBy('id');
        $channels = $channels->reject(function ($channel) {
            return $channel->get('type') !== 0;
        });

        $oldChannels = DiscordChannel::all()->keyBy('id');

        $channels = $channels->diffKeys($oldChannels);

        if ($channels->isEmpty()) {
            return;
        }

        $channels = $channels->values()->map(function ($item) {
            return $item->only(['id', 'name', 'guild_id']);
        });

        DiscordChannel::insert($channels->toArray());

    }
}
