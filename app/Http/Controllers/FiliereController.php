<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Niveau;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::with(['promotions', 'niveau'])->get();
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveaux = Niveau::all();
        return view('filieres.create', compact('niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codeF' => 'required|string|max:20|unique:filieres,codeF',
            'nomF' => 'required|string|max:255',
            'niveau_id' => 'required|exists:niveaux,id',
        ]);

        $filiere = Filiere::create($request->all());

        return redirect()->route('filieres.index')
            ->with('success', 'Filière ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $filiere = Filiere::with(['promotions.etudiants', 'niveau'])->findOrFail($id);
        return view('filieres.show', compact('filiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $filiere = Filiere::with(['promotions', 'niveau'])->findOrFail($id);
        $niveaux = Niveau::all();
        return view('filieres.edit', compact('filiere', 'niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'codeF' => 'required|string|max:20|unique:filieres,codeF,' . $id,
            'nomF' => 'required|string|max:255',
            'niveau_id' => 'required|exists:niveaux,id',
        ]);

        $filiere = Filiere::findOrFail($id);
        $filiere->update($request->all());

        return redirect()->route('filieres.index')
            ->with('success', 'Filière mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $filiere = Filiere::findOrFail($id);
        
        // Vérifier si la filière a des promotions associées
        if ($filiere->promotions->count() > 0) {
            return redirect()->route('filieres.index')
                ->with('error', 'Impossible de supprimer cette filière car elle a des promotions associées.');
        }
        
        $filiere->delete();

        return redirect()->route('filieres.index')
            ->with('success', 'Filière supprimée avec succès.');
    }
}
