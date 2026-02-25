<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Filiere;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = [
            [
                'codeF' => 'INFO',
                'nomF' => 'Informatique'
            ],
            [
                'codeF' => 'GESTION',
                'nomF' => 'Gestion'
            ],
            [
                'codeF' => 'COMPTA',
                'nomF' => 'Comptabilité'
            ],
            [
                'codeF' => 'MARKETING',
                'nomF' => 'Marketing et Communication'
            ],
            [
                'codeF' => 'RESEAU',
                'nomF' => 'Réseaux et Télécommunications'
            ],
        ];

        foreach ($filieres as $filiere) {
            Filiere::create($filiere);
        }
    }
}
