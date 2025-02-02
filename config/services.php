<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => Asgard\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'eveonline' => [
        'client_id' => env('EVEONLINE_CLIENT_ID', ''),
        'client_secret' => env('EVEONLINE_CLIENT_SECRET', ''),
        'redirect' => env('EVEONLINE_REDIRECT', ''),
        'scopes' => env('EVEONLINE_SCOPES', [])
    ],

    'discord' => [
        'client_id' => env('DISCORD_KEY'),
        'client_secret' => env('DISCORD_SECRET'),
        'redirect' => env('DISCORD_REDIRECT_URI'),

        'bot_token' => env('DISCORD_BOT_TOKEN'),
        'token' => env('DISCORD_BOT_TOKEN'),
        'guild_id'  => (int) env('DISCORD_GUILD_ID'), // cast as int
    ],

    'reddit' => [
        'client_id' => env('REDDIT_KEY'),
        'client_secret' => env('REDDIT_SECRET'),
        'redirect' => env('REDDIT_REDIRECT_URI'),

        'subreddit_url' => env('REDDIT_SUBREDDIT_URL')
    ],

];
