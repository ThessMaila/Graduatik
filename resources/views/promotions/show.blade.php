@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Détails de la Promotion</h5>
        <div>
            <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('promotions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations de la Promotion</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">ID Promotion</th>
                        <td>{{ $promotion->idPromotion }}</td>
                    </tr>
                    <tr>
                        <th>Filière</th>
                        <td>{{ $promotion->filiere->codeF }} - {{ $promotion->filiere->nomF }}</td>
                    </tr>
                    <tr>
                        <th>Année de début</th>
                        <td>{{ $promotion->anneeDebut }}</td>
                    </tr>
                    <tr>
                        <th>Année de fin</th>
                        <td>{{ $promotion->anneeFin }}</td>
                    </tr>
                    <tr>
                        <th>Date de création</th>
                        <td>{{ $promotion->created_at->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Étudiants de la Promotion</h4>
                @if($promotion->etudiants->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date d'intégration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promotion->etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->telephone }}</td>
                                <td>{{ $etudiant->pivot->dateIntegration }}</td>
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
                    <p class="text-muted">Aucun étudiant dans cette promotion.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
