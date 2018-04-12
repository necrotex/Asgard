<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Conduit\Conduit;

class Skills extends CharacterUpdateJob
{
    use ConduitAuthTrait;

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        $api->setAuthentication($this->getAuthentication($this->character));
        $response = $api->characters($this->character->id)->skills()->get();

        Character\Skillpoints::updateOrCreate(
            [
                'character_id' => $this->character->id
            ],
            [
                'total_sp' => $response->get('total_sp'),
                'unallocated_sp' => $response->get('unallocated_sp') //this can be null
            ]
        );

        $skillIds = [];

        foreach ($response->skills as $skill) {
            Character\Skill::updateOrCreate(
                [
                    'character_id' => $this->character->id,
                    'skill_id' => $skill->skill_id,
                ],
                [
                    'skillpoints_in_skill' => $skill->skillpoints_in_skill,
                    'trained_skill_level' => $skill->trained_skill_level,
                    'active_skill_level' => $skill->active_skill_level,
                ]
            );

            $skillIds[] = $skill->skill_id;
        }

        //remove extracted skills
        Character\Skill::where('character_id', '=', $this->character->id)->whereNotIn('skill_id', $skillIds)->delete();
    }
}
