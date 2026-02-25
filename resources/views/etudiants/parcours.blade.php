@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Parcours professionnel de {{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Poste</th>
                <th>Structure</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etudiant->professions as $profession)
                <tr>
                    <td>{{ $profession->type }}</td>
                    <td>{{ $profession->poste }}</td>
                    <td>{{ $profession->structure }}</td>
                    <td>{{ $profession->dateDebut ? $profession->dateDebut->format('d/m/Y') : '' }}</td>
                    <td>{{ $profession->dateFin ? $profession->dateFin->format('d/m/Y') : 'En cours' }}</td>
                    <td>{{ $profession->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune expérience professionnelle enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary mt-3">Retour à la liste des étudiants</a>
</div>
@endsection 