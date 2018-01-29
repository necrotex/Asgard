<?php

namespace Asgard\Console\Commands;

use Asgard\Jobs\Reddit\RemoveApprovedSubmitterJob;
use Asgard\Models\RedditUser;
use Asgard\Support\Reddit;
use Illuminate\Console\Command;

class CleanupRedditCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asgard:clean:reddit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove not linked accounts from reddit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reddit = new Reddit();

        $submitters = $reddit->getSubredditContributors();

        foreach($submitters as $submitter) {
            $result = RedditUser::where('nickname', '=', $submitter->name)->get();

            if($result->isEmpty()) {

                dispatch(new RemoveApprovedSubmitterJob($submitter->name));
            }
        }
    }
}
