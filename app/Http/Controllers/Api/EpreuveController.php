<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Epreuve;
use Illuminate\Http\Request;
use App\Models\ParticipantClassement;

class EpreuveController extends Controller
{
    // Liste toutes les épreuves avec leur événement
    public function index()
    {
        $epreuves = Epreuve::with('event')->get();
        return response()->json($epreuves);
    }

    // Afficher une seule épreuve
    public function show($id)
    {
        $epreuve = Epreuve::with('event')->findOrFail($id);
        return response()->json($epreuve);
    }

    // Ajouter une épreuve
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:sport_events,id',
            'title' => 'required|string|max:255',
            'distance' => 'nullable|string|max:50',
            'price' => 'nullable|numeric',
            'details' => 'nullable|string',
            'start_time' => 'nullable|date',
            'max_participants' => 'nullable|integer',
            'current_participants' => 'nullable|integer',
            'difficulty' => 'nullable|string|max:50',
            'elevation_gain' => 'nullable|numeric',
            'age_range' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'registration_close' => 'nullable|date',
        ]);

        $epreuve = Epreuve::create($validated);

        return response()->json($epreuve, 201);
    }

    // Mettre à jour une épreuve
    public function update(Request $request, $id)
    {
        $epreuve = Epreuve::findOrFail($id);

        $validated = $request->validate([
            'event_id' => 'sometimes|exists:sport_events,id',
            'title' => 'sometimes|string|max:255',
            'distance' => 'nullable|string|max:50',
            'price' => 'nullable|numeric',
            'details' => 'nullable|string',
            'start_time' => 'nullable|date',
            'max_participants' => 'nullable|integer',
            'current_participants' => 'nullable|integer',
            'difficulty' => 'nullable|string|max:50',
            'elevation_gain' => 'nullable|numeric',
            'age_range' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'registration_close' => 'nullable|date',
        ]);

        $epreuve->update($validated);

        return response()->json($epreuve);
    }

    // Supprimer une épreuve
    public function destroy($id)
    {
        $epreuve = Epreuve::findOrFail($id);
        $epreuve->delete();

        return response()->json(['message' => 'Épreuve supprimée avec succès']);
    }

    // Récupérer toutes les épreuves d'un événement spécifique
    public function getByEvent($eventId)
{
    $epreuves = Epreuve::where('event_id', $eventId)->get();
    return response()->json($epreuves); // retournera [] si aucune épreuve
}

}
