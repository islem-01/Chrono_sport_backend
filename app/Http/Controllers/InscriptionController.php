<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscriptions;
use App\Models\Epreuve;
use Illuminate\Support\Facades\Log;

class InscriptionController extends Controller
{
    /**
     * Stocker une inscription pour une épreuve
     * POST /api/epreuves/{epreuve}/inscriptions
     */
    public function store(Request $request, $epreuveId)
    {
        Log::info('📩 Inscription reçue', $request->all());

        try {
            // Vérifier que l’épreuve existe
            $epreuve = Epreuve::findOrFail($epreuveId);

            // Validation
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email',
                'telephone' => 'required|string|max:20',
                'date_naissance' => 'required|date',
                'genre' => 'required|in:Homme,Femme',
                'taille_pull' => 'required|in:XS,S,M,L,XL,XXL,XXXL',
                'pays' => 'required|string|max:100',
                'etat' => 'required|string|max:100',
                'ville' => 'required|string|max:100',
                'accept_conditions' => 'required|boolean',
            ]);

            // Ajouter l’ID de l’épreuve
            $validated['epreuve_id'] = $epreuve->id;

            // Création
            $inscription = Inscriptions::create($validated);

            Log::info('✅ Inscription créée', $inscription->toArray());

            return response()->json([
                'message' => 'Inscription réussie',
                'data' => $inscription
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Erreur validation', $e->errors());
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ Erreur inscription: ' . $e->getMessage());
            return response()->json([
                'message' => 'Erreur lors de l\'inscription',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
