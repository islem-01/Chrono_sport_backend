<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscriptions extends Model

{
     use HasFactory;

    protected $fillable = [
        'epreuve_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'genre',
        'taille_pull',
        'pays',
        'etat',
        'ville',
        'accept_conditions',
    ];

    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }
}
