@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Étudiants</h6>
                        <h2 class="mb-0">{{ \App\Models\Etudiant::count() }}</h2>
                    </div>
                    <i class="fas fa-user-graduate fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Diplômes</h6>
                        <h2 class="mb-0">{{ \App\Models\Diplome::count() }}</h2>
                    </div>
                    <i class="fas fa-graduation-cap fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Filières</h6>
                        <h2 class="mb-0">{{ \App\Models\Filiere::count() }}</h2>
                    </div>
                    <i class="fas fa-book fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Promotions</h6>
                        <h2 class="mb-0">{{ \App\Models\Promotion::count() }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>Répartition par Niveau</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Nombre de Diplômés</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Niveau::withCount('diplomes')->get() as $niveau)
                        <tr>
                            <td>{{ $niveau->type }}</td>
                            <td>{{ $niveau->diplomes_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>Répartition par Filière</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Filière</th>
                            <th>Nombre d'Étudiants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $filieres = \App\Models\Filiere::with('promotions.etudiants')->get();
                            foreach($filieres as $filiere) {
                                $filiere->etudiant_count = $filiere->promotions->flatMap(function ($promotion) {
                                    return $promotion->etudiants;
                                })->unique('id')->count();
                            }
                        @endphp
                        
                        @foreach($filieres as $filiere)
                        <tr>
                            <td>{{ $filiere->nomF }}</td>
                            <td>{{ $filiere->etudiant_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>Derniers Étudiants Ajoutés</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date d'Ajout</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Etudiant::latest()->take(5)->get() as $etudiant)
                        <tr>
                            <td>{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->prenom }}</td>
                            <td>{{ $etudiant->email }}</td>
                            <td>{{ $etudiant->telephone }}</td>
                            <td>{{ $etudiant->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <a href="{{ route('etudiants.index') }}" class="btn btn-primary">Voir tous les étudiants</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
