<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'location', 'start_date', 'end_date',
        'category', 'image_path', 'description', 'organizer', 'is_active'
    ];

    public function epreuves()
    {
        return $this->hasMany(Epreuve::class, 'event_id');
    }
}
