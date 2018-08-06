<?php

namespace Asgard\Notifications\Recruitment;

use Asgard\Models\Application;
use Asgard\Models\ApplicationComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class NewApplication extends Notification
{
    use Queueable;
    /**
     * @var ApplicationComment
     */
    public $application;

    /**
     * Create a new notification instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable)
    {
        $applicant = $this->application->applicant->mainCharacter->name;

        return (new DiscordMessage)
            ->embed(
                [
                    'title' => 'New Application from ' . $applicant,
                    'url' => route('applications.show', $this->application),
                ]
            );
    }
}
