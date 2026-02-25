<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Niveau;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveaux = [
            [
                'type' => 'Licence',
                'description' => 'Niveau Licence (Bac+3)'
            ],
            [
                'type' => 'Master',
                'description' => 'Niveau Master (Bac+5)'
            ],
            [
                'type' => 'Doctorat',
                'description' => 'Niveau Doctorat (Bac+8)'
            ],
        ];

        foreach ($niveaux as $niveau) {
            Niveau::create($niveau);
        }
    }
}
