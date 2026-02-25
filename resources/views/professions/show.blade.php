@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('professions.index') }}">Professions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails de la profession</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">{{ $profession->poste }}</h1>
            <p class="text-muted">
                @if($profession->isEnCours())
                    <span class="badge bg-success">En cours</span>
                @else
                    <span class="badge bg-secondary">Terminé</span>
                @endif
                {{ $profession->type }} chez {{ $profession->structure }}
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="btn-group" role="group">
                <a href="{{ route('professions.edit', $profession->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <form action="{{ route('professions.destroy', $profession->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette profession ?')">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Détails de la profession -->
            <div class="card shadow mb-4 animate-fade-in">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-briefcase me-2"></i>Informations sur la profession</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Type de profession</div>
                        <div class="col-md-8">
                            @if($profession->type == 'Stage')
                                <span class="badge bg-info">Stage</span>
                            @elseif($profession->type == 'CDD')
                                <span class="badge bg-warning">CDD</span>
                            @elseif($profession->type == 'CDI')
                                <span class="badge bg-success">CDI</span>
                            @elseif($profession->type == 'Freelance')
                                <span class="badge bg-primary">Freelance</span>
                            @else
                                <span class="badge bg-secondary">{{ $profession->type }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Poste occupé</div>
                        <div class="col-md-8"><strong>{{ $profession->poste }}</strong></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Structure/Entreprise</div>
                        <div class="col-md-8">{{ $profession->structure }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Période</div>
                        <div class="col-md-8">
                            Du <strong>{{ $profession->dateDebut->format('d/m/Y') }}</strong>
                            @if($profession->dateFin)
                                au <strong>{{ $profession->dateFin->format('d/m/Y') }}</strong>
                                <small class="text-muted">({{ $profession->dateDebut->diffInMonths($profession->dateFin) }} mois)</small>
                            @else
                                <span class="badge bg-success ms-2">En cours</span>
                                <small class="text-muted">({{ $profession->dateDebut->diffInMonths(now()) }} mois)</small>
                            @endif
                        </div>
                    </div>
                    
                    @if($profession->description)
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Description</div>
                        <div class="col-md-8">
                            <p>{{ $profession->description }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Informations sur le diplômé -->
            <div class="card shadow mb-4 animate-fade-in">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-graduate me-2"></i>Informations sur le diplômé</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="avatar-circle mb-3">
                            <span class="initials">{{ substr($profession->diplome->etudiant->prenom, 0, 1) }}{{ substr($profession->diplome->etudiant->nom, 0, 1) }}</span>
                        </div>
                        <h5>{{ $profession->diplome->etudiant->prenom }} {{ $profession->diplome->etudiant->nom }}</h5>
                        <p class="text-muted">
                            <span class="badge bg-primary">{{ $profession->diplome->type }}</span>
                            {{ $profession->diplome->specialite }}
                        </p>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-5 text-muted">Email</div>
                        <div class="col-md-7">{{ $profession->diplome->etudiant->email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-5 text-muted">Téléphone</div>
                        <div class="col-md-7">{{ $profession->diplome->etudiant->telephone }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-5 text-muted">Date d'obtention</div>
                        <div class="col-md-7">{{ $profession->diplome->dateObtention }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-5 text-muted">Mention</div>
                        <div class="col-md-7">{{ $profession->diplome->mention }}</div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('diplomes.show', $profession->diplome->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-graduation-cap me-2"></i>Voir le diplôme
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-circle {
        width: 80px;
        height: 80px;
        background-color: #3498db;
        text-align: center;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .initials {
        position: relative;
        font-size: 30px;
        line-height: 30px;
        color: #fff;
        font-weight: bold;
    }
</style>
@endsection
