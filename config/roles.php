<?php

return [

    'director' => [
        config('abilities.corporation.*'),
        config('abilities.discord.director'),
        config('abilities.reddit.mod'),
        config('abilities.characers.*')
    ],

    'member' => [
        config('abilities.discord.member'),
        config('abilities.reddit.user'),
        config('abilities.characters.create'),
        config('abilities.characters.update'),
        config('abilities.characters.delete'),
    ],

];