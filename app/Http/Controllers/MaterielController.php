<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiels = Materiel::with('etudiants')->get();
        return view('materiels.index', compact('materiels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materiels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:50|unique:materiels,reference',
            'designation' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $materiel = Materiel::create($request->all());

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $materiel = Materiel::with('etudiants')->findOrFail($id);
        return view('materiels.show', compact('materiel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $materiel = Materiel::with('etudiants')->findOrFail($id);
        return view('materiels.edit', compact('materiel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'reference' => 'required|string|max:50|unique:materiels,reference,' . $id,
            'designation' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $materiel = Materiel::findOrFail($id);
        $materiel->update($request->all());

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materiel = Materiel::findOrFail($id);
        
        // Vérifier si le matériel a des étudiants associés
        if ($materiel->etudiants->count() > 0) {
            return redirect()->route('materiels.index')
                ->with('error', 'Impossible de supprimer ce matériel car il a des étudiants associés.');
        }
        
        $materiel->delete();

        return redirect()->route('materiels.index')
            ->with('success', 'Matériel supprimé avec succès.');
    }
}
