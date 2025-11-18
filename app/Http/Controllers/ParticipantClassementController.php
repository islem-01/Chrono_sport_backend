<?php

namespace App\Http\Controllers;

use App\Models\ParticipantClassement;
use Illuminate\Http\Request;

class ParticipantClassementController extends Controller
{
    // ✅ Récupérer classement par épreuve
    public function index($epreuveId)
    {
        $classements = ParticipantClassement::where('epreuve_id', $epreuveId)
            ->orderBy('temps', 'asc')
            ->get();

        return response()->json($classements);
    }

    // ✅ Ajouter un participant au classement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'epreuve_id' => 'required|exists:epreuves,id',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'dossard' => 'required|string',
            'pays' => 'required|string',
            'sexe' => 'required|in:H,F',
            'categorie' => 'required|string',
            'temps' => 'required|string',
            'vitesse' => 'nullable|numeric',
            'ecart' => 'nullable|string',
        ]);

        $participant = ParticipantClassement::create($validated);

        return response()->json($participant, 201);
    }

    // ✅ Détails d’un participant
    public function show($id)
    {
        $participant = ParticipantClassement::findOrFail($id);
        return response()->json($participant);
    }

    public function classement(Request $request, $epreuveId)
{
    $filter = $request->query('filter'); // 'general', 'homme', 'femme', 'handisport'
    $topOnly = $request->query('top'); // true = podium, false ou null = classement complet

    $query = ParticipantClassement::where('epreuve_id', $epreuveId);

    if ($filter == 'homme') {
        $query->where('sexe', 'M');
    } elseif ($filter == 'femme') {
        $query->where('sexe', 'F');
    } elseif ($filter == 'handisport') {
        $query->where('categorie', 'like', '%H%'); // ou selon ton système
    }

    $query->orderBy('rang', 'asc');

    if ($topOnly) {
        $classements = $query->take(3)->get();
    } else {
        $classements = $query->get();
    }

    return response()->json($classements);
}

}
