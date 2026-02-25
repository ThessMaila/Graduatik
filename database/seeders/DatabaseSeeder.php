<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder; // Ajout de l'importation

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un utilisateur de test
        User::factory()->create([
            'name' => 'Admin IBAM',
            'email' => 'admin@ibam.bf',
        ]);
        
        // Appeler les seeders dans l'ordre de dépendance
        $this->call([
            NiveauSeeder::class,
            FiliereSeeder::class,
            PromotionSeeder::class,
            EtudiantSeeder::class,
            AdminSeeder::class, // Ajout du seeder Admin
        ]);
    }
}
