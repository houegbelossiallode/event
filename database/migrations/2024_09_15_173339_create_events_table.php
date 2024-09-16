<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'événement
            $table->text('description')->nullable(); // Description de l'événement
            $table->date('date'); // Date de l'événement
            $table->decimal('price', 8, 2); // Prix du ticket
            $table->integer('available_tickets'); // Nombre de tickets disponibles
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};