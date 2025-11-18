<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sport_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('category', 100)->nullable();
            $table->string('image_path', 500)->nullable();
            $table->text('description')->nullable();
            $table->string('organizer')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sport_events');
    }
};
