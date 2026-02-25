@extends('layouts.app')

@section('title', 'Détails de la Filière')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Détails de la Filière</h5>
        <div>
            <a href="{{ route('filieres.edit', $filiere->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations de la Filière</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">Code</th>
                        <td>{{ $filiere->codeF }}</td>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <td>{{ $filiere->nomF }}</td>
                    </tr>
                    <tr>
                        <th>Niveau</th>
                        <td>
                            @if($filiere->niveau)
                                {{ $filiere->niveau->codeN }} - {{ $filiere->niveau->libelleN }}
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Date de création</th>
                        <td>{{ $filiere->created_at->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Promotions associées</h4>
                @if($filiere->promotions->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Promotion</th>
                                <th>Année de début</th>
                                <th>Année de fin</th>
                                <th>Nombre d'étudiants</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filiere->promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->idPromotion }}</td>
                                <td>{{ $promotion->anneeDebut }}</td>
                                <td>{{ $promotion->anneeFin }}</td>
                                <td>{{ $promotion->etudiants->count() }}</td>
                                <td>
                                    <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucune promotion associée à cette filière.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
