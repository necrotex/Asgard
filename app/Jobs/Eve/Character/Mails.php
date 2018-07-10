<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
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
        $response = $api->characters($this->character->id)->mail()->get();

        // only new mails
        $mailItems = collect($response->data)->recursive()->keyBy('mail_id');
        $knownMails = $this->character->mails()->get()->keyBy('mail_id');
        $mails = $mailItems->diffKeys($knownMails);

        if ($mails->isEmpty()) {
            return;
        }

        // get mail senders and recipients
        $response = $api->characters($this->character->id)->mail()->lists()->get();
        $mailingLists = collect($response->data)->recursive()->keyBy('mailing_list_id');

        $senderIds = $mails->pluck('from')->unique();

        $recipientIds = $mails->pluck('recipients')->flatten(1)->reject(function($item) {
            return $item->get('recipient_type') == 'mailing_list';
        })->pluck('recipient_id')->unique();

        $ids = $senderIds->merge($recipientIds)->unique()->reject(function ($v, $k) use ($mailingLists) {
            return $mailingLists->has($v);
        })->values();

        $resolvedIds = collect();
        $ids->chunk(250)->each(function ($item) use ($api, &$resolvedIds) {
            try {
                $response = $api->universe()->names()->data($item->toArray())->post();
                $resolvedIds = $resolvedIds->merge($response->data);
            } catch (\Exception $exception) {
                Log::error('Coudn\'t resolve ids via universe->names.', $item->toArray());
                throw $exception;
            }
        });

        $resolvedIds->recursive();

        $mailingLists->each(function ($item) use (&$resolvedIds) {
            $entry = [
                "category" => "mailing_list",
                "id" => $item->get('mailing_list_id'),
                "name" => $item->get('name'),
            ];

            $resolvedIds->push(collect($entry));
        });

        $resolvedIds = $resolvedIds->recursive()->keyBy('id');

        $newMails = collect();
        $newRecipients = collect();

        $mails->each(function ($mail) use ($api, $resolvedIds, $mailingLists, $newMails, $newRecipients) {
            $response = $api->characters($this->character->id)->mail($mail->get('mail_id'))->get();
            $fullMail = collect($response->data);

            $i = [
                'mail_id' => $mail->get('mail_id'),
                'subject' => strip_tags($fullMail->get('subject'), '<color></color><a></a><b></b>'),
                'content' => strip_tags($fullMail->get('body'), '<color></color><a></a><b></b><br></br>'),
                'sender_name' => $resolvedIds->get($mail->get('from'))->get('name'),
                'sender_type' => $resolvedIds->get($mail->get('from'))->get('category'),
                'sender_id' => $resolvedIds->get($mail->get('from'))->get('id'),
                'date' => Carbon::parse($mail->get('timestamp'))
            ];

            $newMails->push($i);

            $mail->get('recipients')->each(function ($item) use ($mail, $resolvedIds, $newRecipients) {
                $i = [
                    'mail_id' => $mail->get('mail_id'),
                    'type' => $resolvedIds->get($item->get('recipient_id'))->get('category'),
                    'recipient_id' => optional($resolvedIds->get($item->get('recipient_id')))->get('id'),
                    'recipient_name' => optional($resolvedIds->get($item->get('recipient_id')))->get('name'),
                ];

                $newRecipients->push($i);
            });

        });

        $this->character->mails()->createMany($newMails->toArray());
        Character\MailRecipient::insert($newRecipients->toArray());
    }
}
