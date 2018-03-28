<?php

namespace Asgard\Models\Character;

use Asgard\Models\Character;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'character_journals';

    protected $fillable = [
        'character_id',
        'date',
        'ref_id',
        'ref_type',
        'first_party_id',
        'first_party_type',
        'second_party_id',
        'second_party_type',
        'amount',
        'balance',
        'reason',
        'tax_receiver_id',
        'tax',
        'extra_location_id',
        'extra_transaction_id',
        'extra_npc_name',
        'extra_npc_id',
        'extra_destroyed_ship_type_id',
        'extra_character_id',
        'extra_corporation_id',
        'extra_alliance_id',
        'extra_job_id',
        'extra_contract_id',
        'extra_system_id',
        'extra_planet_id'
    ];

    public function character() {
        return $this->belongsTo(Character::class);
    }

}
