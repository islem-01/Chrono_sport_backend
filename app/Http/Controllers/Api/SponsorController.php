<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        // Retourne tous les sponsors
        return response()->json(Sponsor::all());
    }

    public function getByEvent($eventId)
    {
        $sponsors = Sponsor::where('sport_event_id', $eventId)->get();

        if ($sponsors->isEmpty()) {
            return response()->json([]);
        }

        // Convertir le chemin local en URL complète
        $sponsors->transform(function ($sponsor) {
            // Si c'est un chemin local de storage, utilise Storage::url
            if (str_starts_with($sponsor->image, 'storage/')) {
                $sponsor->image = url($sponsor->image);
            }
            return $sponsor;
        });

        return response()->json($sponsors);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'image' => 'required|url',
            'sport_event_id' => 'required|exists:sport_events,id',
        ]);

        $sponsor = Sponsor::create($validated);
        return response()->json($sponsor, 201);
    }
}
