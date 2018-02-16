<?php

namespace Asgard\Http\Resources\Ajax;

use Illuminate\Http\Resources\Json\Resource;

class MailResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->mail_id,
            'subject' => $this->subject,
            'content' => $this->content,
            'sender_name' => $this->sender_name,
            'sender_type' => $this->sender_id,
            'date' => $this->date,
            'recipients' => $this->recipients,
        ];
    }
}
