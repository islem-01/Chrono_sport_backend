<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SportEventController;
use App\Http\Controllers\Api\EpreuveController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ParticipantClassementController;
use App\Http\Controllers\Api\SponsorController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// =====================
// Routes ÉVÉNEMENTS
// =====================
Route::get('/events', [SportEventController::class, 'index']);        // Liste tous les événements
Route::get('/events/{id}', [SportEventController::class, 'show']);    // Détails d'un événement
Route::post('/events', [SportEventController::class, 'store']);       // Créer un événement
Route::get('/events/{id}/epreuves', [EpreuveController::class, 'getByEvent']); // Épreuves d'un événement
// =====================
// Routes ÉPREUVES
// =====================
 
    Route::get('/epreuves', [EpreuveController::class, 'index']);
    Route::get('/epreuves/{id}', [EpreuveController::class, 'show']);
    Route::post('/epreuves', [EpreuveController::class, 'store']);

// =====================
// Routes INSCRIPTIONS
// =====================
// Permet à un utilisateur de s'inscrire à une épreuve (désactive CSRF pour l'API)
Route::post('/epreuves/{epreuve}/inscriptions', [InscriptionController::class, 'store'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('epreuves/{epreuve}/inscriptions', [InscriptionController::class, 'store']);

Route::get('epreuves/{id}/participants', [EpreuveController::class, 'participants']);
Route::get('epreuves/{id}/classement', [EpreuveController::class, 'classement']);

Route::get('/classement/{epreuveId}', [ParticipantClassementController::class, 'index']);
Route::get('/classement/participant/{id}', [ParticipantClassementController::class, 'show']);
Route::get('/epreuves/{epreuveId}/participants', [ParticipantClassementController::class, 'getByEpreuve']);
Route::get('epreuves/{id}/classement', [EpreuveController::class, 'classement']);


Route::get('/sponsors', [SponsorController::class, 'index']);
Route::get('/sponsors/event/{id}', [SponsorController::class, 'getByEvent']);
Route::post('/sponsors', [SponsorController::class, 'store']);