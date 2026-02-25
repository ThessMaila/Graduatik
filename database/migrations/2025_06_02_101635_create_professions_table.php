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
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Type de profession
            $table->string('poste'); // Poste occupé
            $table->string('structure'); // Structure/Entreprise
            $table->date('dateDebut'); // Date de début
            $table->date('dateFin')->nullable(); // Date de fin (peut être null si toujours en cours)
            $table->text('description')->nullable(); // Description du poste
            $table->foreignId('diplome_id')->constrained('diplomes')->onDelete('cascade'); // Relation avec le diplôme
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};
