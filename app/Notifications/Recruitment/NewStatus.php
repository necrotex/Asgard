<?php

namespace Asgard\Notifications\Recruitment;

use Asgard\Models\Application;
use Asgard\Models\ApplicationComment;
use Asgard\Models\ApplicationStatus;
use Asgard\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class NewStatus extends Notification
{
    use Queueable;
    /**
     * @var ApplicationComment
     */
    public $application;
    public $status;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param Application $application
     * @param ApplicationStatus $status
     * @param User $user
     */
    public function __construct(Application $application, ApplicationStatus $status, User $user)
    {
        $this->application = $application;
        $this->user = $user;
        $this->status = $status;
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
                    'title' => 'New Status for ' . $applicant,
                    'description' => $this->status->title,
                    'url' => route('applications.show', $this->application),
                    'footer' => [
                        'text' => $this->user->mainCharacter->name . ' on ' . $this->application->updated_at
                    ]
                ]
            );
    }
}
