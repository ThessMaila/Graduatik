@extends('layouts.app')

@section('content')

<div class="container-fluid p-0" style="background: linear-gradient(135deg, #e3f0ff 0%, #e3ffe9 100%); min-height: 100vh;">
    <div class="row g-4 m-0">
        <div class="col-12">
            <h2 class="fw-bold mb-4 mt-4 text-center" style="font-size:2rem; color:#222;">Tableau de bord - {{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
<!--@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif-->
            <div class="row align-items-stretch">
                <!-- Colonne infos étudiant -->
                <div class="col-md-5 d-flex flex-column">
                    <div class="card mb-3 flex-fill" style="background: #f7fbff;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div style="width:70px;height:70px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;margin:auto;font-size:2.2rem;font-weight:700;color:#2196F3;box-shadow:0 2px 10px rgba(33,150,243,0.11);">
                                    {{ strtoupper(substr($etudiant->prenom,0,1)) }}{{ strtoupper(substr($etudiant->nom,0,1)) }}
                                </div>
                            </div>
                            <h4>{{ $etudiant->prenom }} {{ $etudiant->nom }}</h4>
                            <p class="text-muted">{{ $etudiant->email }}</p>
                            <p class="text-muted">INE : {{ $etudiant->ine ?? '-' }}</p>
                            <hr>
                            <div class="text-start">
                                <p><i class="fas fa-phone me-2"></i>{{ $etudiant->telephone }}</p>
                                <p><i class="fas fa-calendar me-2"></i>Né(e) le {{ $etudiant->dateNaissance }}</p>
                                <p><i class="fas fa-map-marker-alt me-2"></i>{{ $etudiant->lieuNaissance }}</p>
                                @if(isset($etudiant->promotion))
                                    <p><i class="fas fa-map-marker-alt me-2"></i>{{ $etudiant->promotion->annee ?? '-' }}</p>
                                    <p><i class="fas fa-map-marker-alt me-2"></i>{{ $etudiant->promotion->specialite ?? '-' }}</p>
                                    @if(isset($etudiant->promotion->filiere))
                                        <p><i class="fas fa-map-marker-alt me-2"></i>{{ $etudiant->promotion->filiere->nom ?? '-' }}</p>
                                        @if(isset($etudiant->promotion->filiere->niveau))
                                            <p><i class="fas fa-map-marker-alt me-2"></i>{{ $etudiant->promotion->filiere->niveau->nom ?? '-' }}</p>
                                            @if(isset($etudiant->promotion->filiere->niveau->specialite))
                                                <p><i class="fas fa-map-marker-alt me-2"></i>{{ $etudiant->promotion->filiere->niveau->specialite ?? '-' }}</p>
                                            @endif
                                        @endif
                                    @endif
                                @endif

                            </div>
                            @if(isset($diplome))
                            <div class="card mb-4 mt-3 mx-auto" style="background: #e3ffe9; max-width: 400px;">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-2">Diplôme</h5>
                                    <p class="mb-1"><strong>Référence :</strong> {{ $diplome->reference ?? '-' }}</p>
                                    <p class="mb-1"><strong>Type :</strong> {{ $diplome->type ?? '-' }}</p>
                                    <p class="mb-1"><strong>Date d'obtention :</strong> {{ $diplome->dateObtention ? $diplome->dateObtention->format('d/m/Y') : '-' }}</p>
                                    <p class="mb-1"><strong>Mention :</strong> <span class="badge bg-success fs-6">{{ $diplome->mention ?? '-' }}</span></p>
                                </div>
                            </div>
                            @endif
                            @if(isset($etudiant->promotion))
                                <div class="card mb-4 mt-3 mx-auto" style="background: #e3f0ff; max-width: 400px;">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-2">Promotion</h5>
                                        <p class="mb-1"><strong>Année :</strong> {{ $etudiant->promotion->annee ?? '-' }}</p>
                                        <p class="mb-1"><strong>Spécialité :</strong> {{ $etudiant->promotion->specialite ?? '-' }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Colonne parcours professionnel -->
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Parcours Professionnel</h5>
                            <a href="{{ route('etudiant.professions.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i> Ajouter
                            </a>
                        </div>
                        <div class="card-body">
                            @if($professions->isEmpty())
                                <p class="text-muted">Aucune expérience professionnelle enregistrée.</p>
                            @else
                                <div class="row g-3">
                                    @foreach($professions as $profession)
                                        <div class="col-12">
                                            <div class="card shadow-sm border-0 mb-2">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div>
                                                            <span class="fw-bold" style="font-size:1.1rem;">{{ $profession->poste }}</span>
                                                            <span class="badge bg-light text-dark ms-2">{{ $profession->type }}</span>
                                                        </div>
                                                        <a href="{{ route('etudiant.professions.edit', $profession->id) }}" class="btn btn-outline-secondary btn-sm" title="Modifier">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="mb-1"><i class="fas fa-building me-2"></i><strong>Structure :</strong> {{ $profession->structure }}</div>
                                                    <div class="mb-1"><i class="fas fa-calendar-alt me-2"></i><strong>Période :</strong> 
                                                        {{ $profession->dateDebut ? \Carbon\Carbon::parse($profession->dateDebut)->format('d/m/Y') : '-' }} 
                                                        @if($profession->dateFin) - {{ \Carbon\Carbon::parse($profession->dateFin)->format('d/m/Y') }} @endif
                                                    </div>
                                                    <div class="mb-1"><i class="fas fa-align-left me-2"></i><strong>Description :</strong> {{ $profession->description ?? '-' }}</div>
                                                    <!--<div class="mb-1">
                                                        <i class="fas fa-check-circle me-2"></i>
                                                        <strong>Statut :</strong>
                                                        @if($profession->valide === 1)
                                                            <span class="badge bg-success">Validée</span>
                                                        @elseif($profession->valide === 0)
                                                            <span class="badge bg-warning text-dark">En attente</span>
                                                        @else
                                                            <span class="badge bg-secondary">Non renseigné</span>
                                                        @endif
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Bloc statistiques -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex flex-wrap gap-4 w-100 justify-content-around">
                                <!-- Bloc diplôme -->
                                <div class="card shadow-sm mb-2" style="min-width:260px;max-width:300px;flex:1 1 260px;">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-2"><i class="fas fa-certificate me-2"></i>Diplôme</h5>
                                        @if(isset($diplome))
                                            <p class="mb-1"><strong>Référence :</strong> {{ $diplome->reference ?? '-' }}</p>
                                            <p class="mb-1"><strong>Type :</strong> {{ $diplome->type ?? '-' }}</p>
                                            <p class="mb-1"><strong>Date d'obtention :</strong> {{ $diplome->dateObtention ? $diplome->dateObtention->format('d/m/Y') : '-' }}</p>
                                            <p class="mb-1"><strong>Mention :</strong> <span class="badge bg-success fs-6">{{ $diplome->mention ?? '-' }}</span></p>
                                        @else
                                            <p class="text-muted">Aucun diplôme renseigné.</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- Bloc statistiques parcours -->
                                <div class="card shadow-sm mb-2" style="min-width:220px;max-width:260px;flex:1 1 220px;">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-2"><i class="fas fa-chart-bar me-2"></i>Statistiques</h5>
                                        <p class="mb-1"><strong>Expériences totales :</strong> {{ $professions->count() }}</p>
                                        <p class="mb-1"><strong>Validées :</strong> {{ $professions->where('valide',1)->count() }}</p>
                                        <p class="mb-1"><strong>En attente :</strong> {{ $professions->where('valide',0)->count() }}</p>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
