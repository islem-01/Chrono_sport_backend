<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    // Les champs qui peuvent être remplis via create() ou update()
    protected $fillable = [
        'nom',
        'image',
        'sport_event_id',
    ];

    // Relation avec l'événement
    public function event()
    {
        return $this->belongsTo(SportEvent::class, 'sport_event_id');
    }
}
