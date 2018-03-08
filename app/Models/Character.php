<?php

namespace Asgard\Models;

use Asgard\Events\CharacterUpdateEvent;
use Asgard\Models\Character\Asset;
use Asgard\Models\Character\Contact;
use Asgard\Models\Character\CorporationHistory;
use Asgard\Models\Character\CorporationRole;
use Asgard\Models\Character\Fatigue;
use Asgard\Models\Character\Location;
use Asgard\Models\Character\Mail;
use Asgard\Models\Character\Skill;
use Asgard\Models\Character\Skillpoints;
use Asgard\Models\Character\Skillqueue;
use Asgard\Models\Character\Status;
use Asgard\Models\Character\Title;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

    protected $fillable = ['id'];
    protected $casts = [
        'active' => 'boolean'
    ];

    protected $dispatchesEvents = [
        'updated' => CharacterUpdateEvent::class,
        'saved' => CharacterUpdateEvent::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function corporation()
    {
        return $this->belongsTo(Corporation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    public function corporationHistory()
    {
        return $this->hasMany(CorporationHistory::class);
    }

    public function fatigue()
    {
        return $this->hasOne(Fatigue::class);
    }

    public function corporationRoles()
    {
        return $this->hasMany(CorporationRole::class);
    }

    public function titles()
    {
        return $this->hasMany(Title::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function skillqueue()
    {
        return $this->hasMany(Skillqueue::class);
    }

    public function skills() {
        return $this->hasMany(Skill::class);
    }

    public function skillpoints()
    {
        return $this->hasOne(Skillpoints::class);
    }

    public function mails()
    {
        return $this->hasMany(Mail::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

}
