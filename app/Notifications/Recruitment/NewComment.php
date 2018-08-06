<?php

namespace Asgard\Notifications\Recruitment;

use Asgard\Models\ApplicationComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class NewComment extends Notification
{
    use Queueable;
    /**
     * @var ApplicationComment
     */
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @param ApplicationComment $comment
     */
    public function __construct(ApplicationComment $comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable)
    {
        $applicant = $this->comment->application->applicant->mainCharacter->name;

        return (new DiscordMessage)
            ->embed(
                [
                    'title' => 'New Comment for ' . $applicant,
                    'description' => $this->comment->comment,
                    'url' => route('applications.show', $this->comment->application),
                    'footer' => [
                        'text' => $this->comment->author->mainCharacter->name . ' on ' . $this->comment->created_at
                    ]
                ]
            );
    }
}
