<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::with(['diplomes', 'promotions'])
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(10);
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveaux = Niveau::all();
        $filieres = Filiere::all();
        $promotions = Promotion::all();
        return view('etudiants.create', compact('niveaux', 'filieres', 'promotions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'dateNaissance' => 'required|date',
            'lieuNaissance' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'annee_entree' => 'required|integer|min:1900|max:2100',
            'annee_sortie' => 'required|integer|min:1900|max:2100|gte:annee_entree',
        ]);

        $etudiant = Etudiant::create($request->all());

        if ($request->has('promotion_id')) {
            $etudiant->integrations()->create([
                'promotion_id' => $request->promotion_id,
                'dateIntegration' => now(),
            ]);
        }

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etudiant = Etudiant::with(['diplomes.niveau', 'promotions.filiere'])->findOrFail($id);
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $niveaux = Niveau::all();
        $filieres = Filiere::all();
        $promotions = Promotion::all();
        return view('etudiants.edit', compact('etudiant', 'niveaux', 'filieres', 'promotions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $id,
            'dateNaissance' => 'required|date',
            'lieuNaissance' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->update($request->all());

        if ($request->filled('promotion_id') && !$etudiant->promotions->contains($request->promotion_id)) {
            $etudiant->integrations()->create([
                'promotion_id' => $request->promotion_id,
                'dateIntegration' => now(),
            ]);
        }

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }

    /**
     * Afficher le formulaire de définition du mot de passe
     */
    public function editPassword(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('etudiants.password', compact('etudiant'));
    }

    /**
     * Mettre à jour le mot de passe de l'étudiant
     */
    public function updatePassword(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->password = Hash::make($request->password);
        $etudiant->save();

        return redirect()->route('etudiants.index')
            ->with('success', 'Mot de passe défini avec succès.');
    }

    /**
     * Affiche le parcours professionnel d'un étudiant pour l'admin
     */
    public function parcoursProfessionnel($id)
    {
        $etudiant = \App\Models\Etudiant::with(['professions' => function($q) {
            $q->orderBy('dateDebut', 'desc');
        }])->findOrFail($id);
        return view('etudiants.parcours', compact('etudiant'));
    }
}
