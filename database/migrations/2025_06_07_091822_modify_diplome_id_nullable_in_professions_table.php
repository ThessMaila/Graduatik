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
        Schema::table('professions', function (Blueprint $table) {
            // Modify the existing diplome_id column to be nullable
            // The ->change() method requires the doctrine/dbal package:
            // composer require doctrine/dbal
            $table->foreignId('diplome_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professions', function (Blueprint $table) {
            // Revert diplome_id to be not nullable
            // This might fail if there are records with NULL diplome_id
            $table->foreignId('diplome_id')->nullable(false)->change();
        });
    }
};
