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
        // Suppression de la table des matériels
        Schema::dropIfExists('materiels');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recréation de la table des matériels
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('piece');
            $table->string('structure');
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
