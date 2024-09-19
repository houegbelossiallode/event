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
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
            $table->date('date_realisation');
            $table->integer('nombre'); // Nombre de ventes/réalisations
            $table->decimal('chiffre', 15, 2); // Chiffre d'affaires
            $table->integer('id_objectif');
            $table->integer('id_commercial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisations');
    }
};