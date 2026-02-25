<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use App\Models\Etudiant;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Diplome::with(['etudiant', 'niveau']);
        
        // Filtrage par type de diplôme
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        
        // Filtrage par niveau
        if ($request->has('niveau_id')) {
            $query->where('niveau_id', $request->niveau_id);
        }
        
        $diplomes = $query
            ->join('etudiants', 'diplomes.etudiant_id', '=', 'etudiants.id')
            ->orderBy('etudiants.nom')
            ->orderBy('etudiants.prenom')
            ->select('diplomes.*')
            ->get();
        $niveaux = Niveau::all();
        
        return view('diplomes.index', compact('diplomes', 'niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiant::all();
        $niveaux = Niveau::all();
        $types = [
            Diplome::TYPE_LICENCE => 'Licence',
            Diplome::TYPE_MASTER => 'Master',
            Diplome::TYPE_DOCTORAT => 'Doctorat'
        ];
        
        return view('diplomes.create', compact('etudiants', 'niveaux', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation de base pour tous les types de diplômes
        $validationRules = [
            'reference' => 'required|string|max:50|unique:diplomes,reference',
            'etudiant_id' => 'required|exists:etudiants,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'dateObtention' => 'required|date',
            'dateRemise' => 'nullable|date|after_or_equal:dateObtention',
            'mention' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
        ];
        
        // Validation spécifique selon le type de diplôme
        if ($request->type === Diplome::TYPE_LICENCE) {
            $validationRules['sujetMemoire'] = 'nullable|string';
            $validationRules['encadreur'] = 'nullable|string|max:255';
        } elseif ($request->type === Diplome::TYPE_MASTER) {
            $validationRules['sujetMemoire'] = 'required|string';
            $validationRules['encadreur'] = 'required|string|max:255';
            $validationRules['mentionSpeciale'] = 'nullable|string|max:255';
        } elseif ($request->type === Diplome::TYPE_DOCTORAT) {
            $validationRules['sujetThese'] = 'required|string';
            $validationRules['directeurThese'] = 'required|string|max:255';
            $validationRules['laboratoire'] = 'required|string|max:255';
            $validationRules['mentionSpeciale'] = 'nullable|string|max:255';
        }
        
        $validated = $request->validate($validationRules);

        // Déduire automatiquement le type à partir du niveau
        $niveau = \App\Models\Niveau::find($validated['niveau_id']);
        $type = null;
        if ($niveau) {
            if (stripos($niveau->libelleN ?? '', 'licence') !== false) {
                $type = 'Licence';
            } elseif (stripos($niveau->libelleN ?? '', 'master') !== false) {
                $type = 'Master';
            } elseif (stripos($niveau->libelleN ?? '', 'doctorat') !== false) {
                $type = 'Doctorat';
            }
        }
        $validated['type'] = $type ?? 'Licence'; // Valeur par défaut

        try {
            DB::beginTransaction();
            
            $diplome = Diplome::create($validated);
            
            DB::commit();
            
            return redirect()->route('diplomes.index')
                ->with('success', 'Diplôme ajouté avec succès.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'ajout du diplôme: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $diplome = Diplome::with(['etudiant', 'niveau'])->findOrFail($id);
        $specificFields = $diplome->getSpecificFields();
        
        return view('diplomes.show', compact('diplome', 'specificFields'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diplome = Diplome::findOrFail($id);
        $etudiants = Etudiant::all();
        $niveaux = Niveau::all();
        $types = [
            Diplome::TYPE_LICENCE => 'Licence',
            Diplome::TYPE_MASTER => 'Master',
            Diplome::TYPE_DOCTORAT => 'Doctorat'
        ];
        
        return view('diplomes.edit', compact('diplome', 'etudiants', 'niveaux', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $diplome = Diplome::findOrFail($id);
        
        // Validation de base pour tous les types de diplômes
        $validationRules = [
            'reference' => 'required|string|max:50|unique:diplomes,reference,' . $id,
            'etudiant_id' => 'required|exists:etudiants,id',
            // 'type' supprimé de la validation
            'niveau_id' => 'required|exists:niveaux,id',
            'dateObtention' => 'required|date',
            'dateRemise' => 'nullable|date|after_or_equal:dateObtention',
            'mention' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
        ];
        
        // Validation spécifique selon le type de diplôme
        if ($request->type === Diplome::TYPE_LICENCE) {
            $validationRules['sujetMemoire'] = 'nullable|string';
            $validationRules['encadreur'] = 'nullable|string|max:255';
        } elseif ($request->type === Diplome::TYPE_MASTER) {
            $validationRules['sujetMemoire'] = 'required|string';
            $validationRules['encadreur'] = 'required|string|max:255';
            $validationRules['mentionSpeciale'] = 'nullable|string|max:255';
        } elseif ($request->type === Diplome::TYPE_DOCTORAT) {
            $validationRules['sujetThese'] = 'required|string';
            $validationRules['directeurThese'] = 'required|string|max:255';
            $validationRules['laboratoire'] = 'required|string|max:255';
            $validationRules['mentionSpeciale'] = 'nullable|string|max:255';
        }
        
        $validated = $request->validate($validationRules);

        // Déduire automatiquement le type à partir du niveau
        $niveau = \App\Models\Niveau::find($validated['niveau_id']);
        $type = null;
        if ($niveau) {
            if (stripos($niveau->libelleN ?? '', 'licence') !== false) {
                $type = 'Licence';
            } elseif (stripos($niveau->libelleN ?? '', 'master') !== false) {
                $type = 'Master';
            } elseif (stripos($niveau->libelleN ?? '', 'doctorat') !== false) {
                $type = 'Doctorat';
            }
        }
        $validated['type'] = $type ?? 'Licence'; // Valeur par défaut

        try {
            DB::beginTransaction();
            
            $diplome->update($validated);
            
            DB::commit();
            
            return redirect()->route('diplomes.show', $diplome->id)
                ->with('success', 'Diplôme mis à jour avec succès.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du diplôme: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diplome = Diplome::findOrFail($id);
        $diplome->delete();

        return redirect()->route('diplomes.index')
            ->with('success', 'Diplôme supprimé avec succès.');
    }
}
