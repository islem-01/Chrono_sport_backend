<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscriptions;

class Epreuve extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'title',
        'distance',
        'price',
        'details',
        'start_time',
        'max_participants',
        'current_participants',
        'difficulty',
        'elevation_gain',
        'age_range',
        'gender',
        'registration_close',
    ];

    protected $dates = [
        'start_time',
        'registration_close',
    ];

    public function event()
    {
        return $this->belongsTo(SportEvent::class, 'event_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscriptions::class);
    }
}
