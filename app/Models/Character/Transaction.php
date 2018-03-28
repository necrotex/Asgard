<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'character_transactions';

    protected $fillable = [
        'character_id',
        'transaction_id',
        'date',
        'type_id',
        'location_id',
        'unit_price',
        'quantity',
        'client_id',
        'is_buy',
        'is_personal',
        'journal_ref_id',
    ];


    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function journalEntry()
    {
        $this->hasOne(Journal::class, 'ref_id', 'journal_ref_id');
    }
}
