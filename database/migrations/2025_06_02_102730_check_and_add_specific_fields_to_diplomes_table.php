<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('diplomes', function (Blueprint $table) {
            // Vérifier et ajouter les colonnes une par une
            if (!Schema::hasColumn('diplomes', 'reference')) {
                $table->string('reference')->nullable()->after('mention');
            }
            
            if (!Schema::hasColumn('diplomes', 'specialite')) {
                $table->string('specialite')->nullable()->after('reference');
            }
            
            if (!Schema::hasColumn('diplomes', 'dateRemise')) {
                $table->date('dateRemise')->nullable()->after('dateObtention');
            }
            
            if (!Schema::hasColumn('diplomes', 'sujetMemoire')) {
                $table->string('sujetMemoire')->nullable()->after('specialite');
            }
            
            if (!Schema::hasColumn('diplomes', 'encadreur')) {
                $table->string('encadreur')->nullable()->after('sujetMemoire');
            }
            
            if (!Schema::hasColumn('diplomes', 'sujetThese')) {
                $table->string('sujetThese')->nullable()->after('encadreur');
            }
            
            if (!Schema::hasColumn('diplomes', 'directeurThese')) {
                $table->string('directeurThese')->nullable()->after('sujetThese');
            }
            
            if (!Schema::hasColumn('diplomes', 'laboratoire')) {
                $table->string('laboratoire')->nullable()->after('directeurThese');
            }
            
            if (!Schema::hasColumn('diplomes', 'mentionSpeciale')) {
                $table->string('mentionSpeciale')->nullable()->after('laboratoire');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diplomes', function (Blueprint $table) {
            //
        });
    }
};
