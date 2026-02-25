<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Diplome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfessionController extends Controller
{
    /**
     * Affiche la liste des professions.
     */
    public function index(Request $request)
    {
        $query = Profession::with(['etudiant']);
        
        // Filtrage par type de profession
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }
        
        // Filtrage par structure
        if ($request->has('structure') && !empty($request->structure)) {
            $query->where('structure', 'like', '%' . $request->structure . '%');
        }
        
        // Filtrage par diplôme
        if ($request->has('diplome_id') && !empty($request->diplome_id)) {
            $query->where('diplome_id', $request->diplome_id);
        }
        
        $professions = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('professions.index', compact('professions'));
    }

    /**
     * Affiche le formulaire de création d'une profession.
     */
    public function create(Request $request)
    {
        $diplomes = Diplome::with('etudiant')->get();
        $diplome_id = $request->input('diplome_id');
        return view('professions.create', compact('diplomes', 'diplome_id'));
    }

    /**
     * Enregistre une nouvelle profession.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'structure' => 'required|string|max:255',
            'dateDebut' => 'required|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'description' => 'nullable|string',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            
            // Associer l'étudiant connecté à la profession
            $data = $request->all();
            $data['etudiant_id'] = auth()->user()->id;
            Profession::create($data);
            
            DB::commit();
            
            return redirect()->route('professions.index')
                ->with('success', 'La profession a été ajoutée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'ajout de la profession: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Affiche les détails d'une profession.
     */
    public function show(string $id)
    {
        $profession = Profession::with(['etudiant'])->findOrFail($id);
        return view('professions.show', compact('profession'));
    }

    /**
     * Affiche le formulaire de modification d'une profession.
     */
    public function edit(string $id)
    {
        $profession = Profession::findOrFail($id);
        $diplomes = Diplome::with('etudiant')->get();
        return view('professions.edit', compact('profession', 'diplomes'));
    }

    /**
     * Met à jour une profession.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'structure' => 'required|string|max:255',
            'dateDebut' => 'required|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'description' => 'nullable|string',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            
            $profession = Profession::findOrFail($id);
            $profession->update($request->all());
            
            DB::commit();
            
            return redirect()->route('admin.professions.liste')
                ->with('success', 'La profession a été mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de la profession: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Supprime une profession.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            
            $profession = Profession::findOrFail($id);
            $profession->delete();
            
            DB::commit();
            
            return redirect()->route('professions.index')
                ->with('success', 'La profession a été supprimée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression de la profession: ' . $e->getMessage());
        }
    }
}
