<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;

class Mails extends CharacterUpdateJob
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
                    'subject' => strip_tags($mail->subject, '<color></color><a></a><b></b>'),
                    'content' => strip_tags($mail->body, '<color></color><a></a><b></b><br></br>'),

                    'sender_name' => $from->data[0]->name,
                    'sender_type' => $from->data[0]->category,
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
