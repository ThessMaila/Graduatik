<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\Diplome;
use App\Models\Niveau;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = Promotion::all();
        $niveaux = Niveau::all();
        
        $etudiants = [
            [
                'nom' => 'Ouedraogo',
                'prenom' => 'Fatima',
                'email' => 'fatima.ouedraogo@example.com',
                'dateNaissance' => '1998-05-15',
                'lieuNaissance' => 'Ouagadougou',
                'telephone' => '+226 70123456',
                'ine' => 'INE001',
                'password' => 'password'
            ],
            [
                'nom' => 'Kaboré',
                'prenom' => 'Ibrahim',
                'email' => 'ibrahim.kabore@example.com',
                'dateNaissance' => '1999-08-22',
                'lieuNaissance' => 'Bobo-Dioulasso',
                'telephone' => '+226 75789012',
                'ine' => 'INE002',
                'password' => 'password'
            ],
            [
                'nom' => 'Traoré',
                'prenom' => 'Aminata',
                'email' => 'aminata.traore@example.com',
                'dateNaissance' => '2000-03-10',
                'lieuNaissance' => 'Koudougou',
                'telephone' => '+226 76543210',
                'ine' => 'INE003',
                'password' => 'password'
            ],
            [
                'nom' => 'Sawadogo',
                'prenom' => 'Moussa',
                'email' => 'moussa.sawadogo@example.com',
                'dateNaissance' => '1997-11-28',
                'lieuNaissance' => 'Ouahigouya',
                'telephone' => '+226 72345678',
                'ine' => 'INE004',
                'password' => 'password'
            ],
            [
                'nom' => 'Diallo',
                'prenom' => 'Aïcha',
                'email' => 'aicha.diallo@example.com',
                'dateNaissance' => '2001-07-05',
                'lieuNaissance' => 'Banfora',
                'telephone' => '+226 77890123',
                'ine' => 'INE005',
                'password' => 'password'
            ],
        ];

        foreach ($etudiants as $index => $etudiantData) {
            // Créer l'étudiant
            $etudiant = Etudiant::create($etudiantData);
            
            // Associer à une promotion
            $promotion = $promotions[$index % $promotions->count()];
            $etudiant->integrations()->create([
                'promotion_id' => $promotion->id,
                'dateIntegration' => now()->subYears(rand(1, 3))->format('Y-m-d')
            ]);
            
            // Créer un diplôme pour certains étudiants
            if ($index % 2 == 0) {
                $niveau = $niveaux->random();
                Diplome::create([
                    'type' => 'Diplôme ' . $niveau->type,
                    'dateObtention' => now()->subYears(rand(0, 2))->format('Y-m-d'),
                    'mention' => ['Passable', 'Assez Bien', 'Bien', 'Très Bien'][rand(0, 3)],
                    'etudiant_id' => $etudiant->id,
                    'niveau_id' => $niveau->id
                ]);
            }
        }
    }
}
