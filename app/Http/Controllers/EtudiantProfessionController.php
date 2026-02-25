<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantProfessionController extends Controller
{
    use AuthorizesRequests;

    public function dashboard()
    {
        $etudiant = Auth::guard('etudiant')->user();
        $professions = $etudiant->professions()->orderBy('dateDebut', 'desc')->get();
        return view('etudiant.dashboard', compact('etudiant', 'professions'));
    }

    public function create()
    {
        return view('etudiant.professions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:Stage,Emploi,Alternance,Volontariat,Autre',
            'poste' => 'required|string|max:255',
            'structure' => 'required|string|max:255',
            'dateDebut' => 'required|date',
            'dateFin' => 'nullable|date|after:dateDebut',
            'description' => 'nullable|string',
            'secteurActivite' => 'required|string|max:255',
            'localisation' => 'required|string|max:255'
        ]);

        $etudiant = Auth::guard('etudiant')->user();

        $profession = new Profession($request->all());
        $profession->etudiant_id = $etudiant->id;
        $profession->diplome_id = null; // Le diplôme sera lié par l'admin
        $profession->save();

        // Création de la notification pour l'admin
        \App\Models\Notification::create([
            'etudiant_id' => $etudiant->id,
            'type' => 'parcours_pro',
            'message' => 'Nouveau parcours pro soumis par ' . $etudiant->prenom . ' ' . $etudiant->nom,
            'ressource_id' => $profession->id // Lier la notification à la profession
        ]);

        return redirect()->route('etudiant.dashboard')
            ->with('success', 'Expérience professionnelle ajoutée. Elle est en attente de validation.');
    }

    public function edit(Profession $profession)
    {
        $this->authorize('update', $profession);
        return view('etudiant.professions.edit', compact('profession'));
    }

    public function update(Request $request, Profession $profession)
{
    $this->authorize('update', $profession);

    $request->validate([
        'type' => 'required|string|in:Stage,Emploi,Alternance,Volontariat,Autre',
        'poste' => 'required|string|max:255',
        'structure' => 'required|string|max:255',
        'dateDebut' => 'required|date',
        'dateFin' => 'nullable|date|after:dateDebut',
        'description' => 'nullable|string',
        'secteurActivite' => 'required|string|max:255',
        'localisation' => 'required|string|max:255'
    ]);

    $profession->update($request->all());

    // Création notification admin (mise à jour)
    $notif = \App\Models\Notification::create([
        'etudiant_id' => $profession->etudiant_id,
        'type' => 'parcours_pro',
        'message' => 'Mise à jour du parcours professionnel',
    ]);
    \Log::info('Notification créée (update)', ['notif' => $notif]);

    return redirect()->route('etudiant.dashboard')
        ->with('success', 'Expérience professionnelle mise à jour avec succès.');
}

}