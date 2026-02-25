<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Filiere;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::with(['filiere', 'etudiants'])->get();
        return view('promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filieres = Filiere::all();
        return view('promotions.create', compact('filieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPromotion' => 'required|string|max:20|unique:promotions,idPromotion',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $promotion = Promotion::create($request->only(['idPromotion', 'filiere_id']));

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promotion = Promotion::with(['filiere', 'etudiants'])->findOrFail($id);
        return view('promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promotion = Promotion::with(['filiere', 'etudiants'])->findOrFail($id);
        $filieres = Filiere::all();
        return view('promotions.edit', compact('promotion', 'filieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idPromotion' => 'required|string|max:20|unique:promotions,idPromotion,' . $id,
            'filiere_id' => 'required|exists:filieres,id',
            'anneeDebut' => 'required|string|max:4',
            'anneeFin' => 'required|string|max:4|gte:anneeDebut',
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->all());

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion mise à jour avec succès.');
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy(string $id)
    {
        $promotion = Promotion::findOrFail($id);
        
        // Vérifier si la promotion a des étudiants associés
        if ($promotion->etudiants->count() > 0) {
            return redirect()->route('promotions.index')
                ->with('error', 'Impossible de supprimer cette promotion car elle a des étudiants associés.');
        }
        
        $promotion->delete();

        return redirect()->route('promotions.index')
            ->with('success', 'Promotion supprimée avec succès.');
    }
}
