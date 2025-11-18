<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participant_classements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('epreuve_id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('dossard')->nullable();
            $table->string('pays')->nullable();
            $table->string('sexe', 10)->nullable();
            $table->string('categorie')->nullable();
            $table->string('temps')->nullable(); // format HH:MM:SS
            $table->decimal('vitesse', 5, 2)->nullable(); // km/h
            $table->string('ecart')->nullable(); // par rapport au 1er
            $table->integer('rang'); // position dans le classement
            $table->timestamps();

            // clé étrangère vers la table epreuves
            $table->foreign('epreuve_id')->references('id')->on('epreuves')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_classements');
    }
};
