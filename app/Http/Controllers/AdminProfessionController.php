<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class AdminProfessionController extends Controller
{
    // Affiche la liste complète des étudiants et de leur dernière profession
    public function liste()
    {
        $etudiants = Etudiant::with([
            'professions' => function($q) {
                $q->orderByDesc('created_at');
            },
            'promotions.filiere'
        ])
        ->orderBy('nom')
        ->orderBy('prenom')
        ->get();

        return view('professions.liste', compact('etudiants'));
    }
}
