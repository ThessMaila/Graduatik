<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Filiere;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = Filiere::all();

        $promotions = [
            [
                'idPromotion' => 'INFO-2022',
                'anneeDebut' => '2022',
                'anneeFin' => '2025',
                'filiere_id' => $filieres->where('codeF', 'INFO')->first()->id
            ],
            [
                'idPromotion' => 'GESTION-2022',
                'anneeDebut' => '2022',
                'anneeFin' => '2025',
                'filiere_id' => $filieres->where('codeF', 'GESTION')->first()->id
            ],
            [
                'idPromotion' => 'COMPTA-2023',
                'anneeDebut' => '2023',
                'anneeFin' => '2026',
                'filiere_id' => $filieres->where('codeF', 'COMPTA')->first()->id
            ],
            [
                'idPromotion' => 'MARKETING-2023',
                'anneeDebut' => '2023',
                'anneeFin' => '2026',
                'filiere_id' => $filieres->where('codeF', 'MARKETING')->first()->id
            ],
            [
                'idPromotion' => 'RESEAU-2024',
                'anneeDebut' => '2024',
                'anneeFin' => '2027',
                'filiere_id' => $filieres->where('codeF', 'RESEAU')->first()->id
            ],
        ];

        foreach ($promotions as $promotion) {
            Promotion::create($promotion);
        }
    }
}
