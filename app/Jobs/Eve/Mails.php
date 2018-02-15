<?php

namespace Asgard\Jobs\Eve;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Mails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConduitAuthTrait;

    /**
     * @var Character
     */
    protected $character;

    /**
     * Create a new job instance.
     *
     * @param Character $character
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        $api->setAuthentication($this->getAuthentication($this->character));

        $mailList = $api->characters($this->character->id)->mail()->get();

        foreach($mailList->data as $item) {
            $mail = $api->characters($this->character->id)->mail($item->mail_id)->get();

            $from = $api->universe()->names()->data([$item->from])->post();

            $mailModel = Character\Mail::firstOrCreate(
                [
                    'character_id' => $this->character->id,
                    'mail_id' => $item->mail_id
                ],
                [
                    'subject' => $mail->subject,
                    'content' => $mail->body,

                    'sender_name' => $from->data[0]->name,
                    'sender_id' => $item->from,

                    'date' => Carbon::parse($item->timestamp),
                ]
            );

            if($mailModel->wasRecentlyCreated) {
                foreach($item->recipients as $recipient) {
                    $recipientName = $api->universe()->names()->data([$recipient->recipient_id])->post();

                    Character\MailRecipient::insert(
                        [
                            'mail_id' => $item->mail_id,
                            'type' => $recipient->recipient_type,
                            'recipient_id' => $recipient->recipient_id,
                            'recipient_name' => $recipientName->data[0]->name,
                        ]
                    );
                }
            }
        }
    }
}
