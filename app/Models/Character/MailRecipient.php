<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class MailRecipient extends Model
{
    protected $table = 'character_mail_recipients';
    protected $fillable = ['mail_id', 'type', 'recipient_id', 'recipient_name'];

    public $timestamps = false;
}
