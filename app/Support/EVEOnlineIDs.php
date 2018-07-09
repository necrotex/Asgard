<?php

namespace Asgard\Support;

class EVEOnlineIDs
{

    const ranges = [
        'system_items' => [0, 10000],
        'factions' => [500000, 1000000],
        'npc_corporations' => [1000000, 2000000],
        'npc_characters' => [3000000, 4000000],
        'universes' => [9000000, 10000000],
        'regions' => [10000000, 11000000],
        'wormhole_regions' => [11000000, 12000000],
        'constellations' => [20000000, 21000000],
        'wormhole_constellations' => [21000000, 22000000],
        'systems' => [30000000, 31000000],
        'wormhole_systems' => [31000000, 32000000],
        'celestials' => [40000000, 50000000],
        'stargates' => [50000000, 60000000],
        'stations' => [60000000, 61000000],
        'outposts' => [61000000, 64000000],
        'station_folders' => [68000000, 69000000],
        'outpost_folders' => [69000000, 70000000],
        'asteroids' => [70000000, 80000000],
        'control_bunkers' => [80000000, 80100000],
        'wis_promenades' => [81000000, 82000000],
        'planetary_districts' => [82000000, 85000000],
        'characters_after_2010-11-03' => [90000000, 98000000],
        'corporations_after_2010-11-03' => [98000000, 99000000],
        'alliances_after_2010-11-03' => [99000000, 100000000],
        'characters_corporations_alliances_before_2010-11-03' => [100000000	, 2100000000],
        'characters_after_2016-05-30' => [2100000000, 2147483647],

    ];

    public static function sort(array $ids)
    {
        $sorted = [];

        foreach ($ids as $id) {
            foreach (self::ranges as $type => $range) {
                if ($id > $range[0] && $id < $range[1]) {
                    $sorted[$type][] = $id;
                    continue 2;
                }
            }
        }

        return $sorted;
    }

}