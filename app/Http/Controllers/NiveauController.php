<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::with('filieres')->get();
        return view('niveaux.index', compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('niveaux.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:10|unique:niveaux,type',
            'description' => 'required|string|max:255',
        ]);

        $niveau = Niveau::create($request->all());

        return redirect()->route('niveaux.index')
            ->with('success', 'Niveau ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $niveau = Niveau::with(['filieres.promotions'])->findOrFail($id);
        return view('niveaux.show', compact('niveau'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $niveau = Niveau::with('filieres')->findOrFail($id);
        return view('niveaux.edit', compact('niveau'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => [
                'required',
                'string',
                'max:10',
                Rule::unique('niveaux', 'type')->ignore($id),
            ],
            'description' => 'required|string|max:255',
        ]);

        $niveau = Niveau::findOrFail($id);
        $niveau->update($request->all());

        return redirect()->route('niveaux.index')
            ->with('success', 'Niveau mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $niveau = Niveau::findOrFail($id);
        
        // Vérifier si le niveau a des filières associées
        if ($niveau->filieres->count() > 0) {
            return redirect()->route('niveaux.index')
                ->with('error', 'Impossible de supprimer ce niveau car il a des filières associées.');
        }
        
        $niveau->delete();

        return redirect()->route('niveaux.index')
            ->with('success', 'Niveau supprimé avec succès.');
    }
}
