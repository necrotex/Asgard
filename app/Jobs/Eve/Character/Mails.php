<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Asgard\Support\EVEOnlineIDs;
use Carbon\Carbon;
use Conduit\Conduit;
use Conduit\Exceptions\HttpStatusException;
use Log;

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

            $id = EVEOnlineIDs::sort([$item->from]);
            Log::debug('Mail sender', ['sender' => print_r($id, true)]);

            try {
                $from = $api->universe()->names()->data([$item->from])->post();

                $sender = $from->data[0]->name;
                $category = $from->data[0]->category;
            } catch (HttpStatusException $e) {
                Log::error("Can't get sender from mail", [$mail, $item]);

                $sender = "n/a (Could not resolve id: $item->from)";
                $category = null;
            }

            $mailModel = Character\Mail::firstOrCreate(
                [
                    'character_id' => $this->character->id,
                    'mail_id' => $item->mail_id
                ],
                [
                    'subject' => strip_tags($mail->subject, '<color></color><a></a><b></b>'),
                    'content' => strip_tags($mail->body, '<color></color><a></a><b></b><br></br>'),

                    'sender_name' => $sender,
                    'sender_type' => $category,
                    'sender_id' => $item->from,

                    'date' => Carbon::parse($item->timestamp),
                ]
            );

            if($mailModel->wasRecentlyCreated) {
                foreach($item->recipients as $recipient) {
                    try{
                        $recipientName = $api->universe()->names()->data([$recipient->recipient_id])->post();

                        Character\MailRecipient::insert(
                            [
                                'mail_id' => $item->mail_id,
                                'type' => $recipient->recipient_type,
                                'recipient_id' => $recipient->recipient_id,
                                'recipient_name' => $recipientName->data[0]->name,
                            ]
                        );
                    } catch (\Exception $e) {
                        Log::error('Could not reoslve recipient id for mail.', [$mail, $recipient]);
                    }
                }
            }
        }
    }
}
