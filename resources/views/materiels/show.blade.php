@extends('layouts.app')

@section('title', 'Détails du Matériel')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Détails du Matériel</h5>
        <div>
            <a href="{{ route('materiels.edit', $materiel->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('materiels.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations du Matériel</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">Référence</th>
                        <td>{{ $materiel->reference }}</td>
                    </tr>
                    <tr>
                        <th>Désignation</th>
                        <td>{{ $materiel->designation }}</td>
                    </tr>
                    <tr>
                        <th>Quantité disponible</th>
                        <td>{{ $materiel->quantite }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $materiel->description ?: 'Aucune description' }}</td>
                    </tr>
                    <tr>
                        <th>Date de création</th>
                        <td>{{ $materiel->created_at->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Étudiants associés à ce matériel</h4>
                @if($materiel->etudiants->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Date d'attribution</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materiel->etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->matricule }}</td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->pivot->dateAttribution }}</td>
                                <td>
                                    <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucun étudiant associé à ce matériel.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
