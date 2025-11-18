<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantClassement extends Model
{
    use HasFactory;

    protected $fillable = [
        'epreuve_id',
        'nom',
        'prenom',
        'dossard',
        'pays',
        'sexe',
        'categorie',
        'temps',
        'vitesse',
        'ecart',
        'rang',
    ];

    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }
}
