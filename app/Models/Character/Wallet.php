<?php

namespace Asgard\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'character_wallets';

    public $fillable = ['character_id', 'amount'];

}
