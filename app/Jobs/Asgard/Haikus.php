<?php

namespace Asgard\Jobs\Asgard;

use Asgard\Models\Application;
use Asgard\Models\ApplicationFormQuestionAnswer;
use Asgard\Models\Haiku;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Haikus implements ShouldQueue
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
        $haikus = Haiku::whereNotNull('application_id')->get();

        $applications = ApplicationFormQuestionAnswer::where('question', 'like', '%haiku%')
            ->whereNotIn('application_id', $haikus->pluck('application_id')->toArray())->get();

        $newHaikus = collect();
        $applications->each(function ($item) use ($newHaikus) {
            $i = [
                'author' => $item->application->applicant->mainCharacter->name,
                'text' => $item->answer,
                'application_id' => $item->application->id
            ];

            $newHaikus->push($i);
        });

        Haiku::insert($newHaikus->toArray());
    }
}
