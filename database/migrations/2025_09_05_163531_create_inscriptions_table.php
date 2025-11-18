<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('epreuve_id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone')->nullable();   // ✅ autorise null
            $table->date('date_naissance')->nullable(); // ✅ autorise null
            $table->enum('genre', ['Homme', 'Femme']); // ⚠️ Flutter doit envoyer exactement "Homme" ou "Femme"
            $table->enum('taille_pull', ['XS','S','M','L','XL','XXL','XXXL']);
            $table->string('pays')->nullable();
            $table->string('etat')->nullable();
            $table->string('ville')->nullable();
            $table->boolean('accept_conditions')->default(false);
            $table->timestamps();

            // Clé étrangère
            $table->foreign('epreuve_id')
                  ->references('id')->on('epreuves')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
