<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('epreuves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                  ->constrained('sport_events')
                  ->onDelete('cascade');
            $table->string('title');
            $table->string('distance', 50)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->text('details')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->integer('max_participants')->default(1000);
            $table->integer('current_participants')->default(0);
            $table->string('difficulty', 50)->default('Moyen');
            $table->double('elevation_gain')->default(0);
            $table->string('age_range', 50)->nullable(); // ex: "18-35 ans"
            $table->string('gender', 20)->default('Mixte'); // Homme / Femme / Mixte
            $table->dateTime('registration_close')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('epreuves');
    }
};
