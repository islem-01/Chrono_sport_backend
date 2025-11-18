<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('image'); // Lien vers une image externe (URL)
            $table->foreignId('sport_event_id')->constrained('sport_events')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sponsors');
    }
};
