<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'character_mails';
    protected $fillable = ['character_id', 'mail_id', 'subject', 'content', 'sender_type', 'sender_name', 'sender_id', 'date'];

    protected $casts = [
        'date' => 'datetime'
    ];

    public $timestamps = false;

    public function recipients()
    {
        return $this->hasMany(MailRecipient::class, 'mail_id', 'mail_id');
    }
}
