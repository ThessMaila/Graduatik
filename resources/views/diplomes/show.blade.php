@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Détails du Diplôme</h5>
        <div>
            <a href="{{ route('diplomes.edit', $diplome->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('diplomes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations du Diplôme</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">Référence</th>
                        <td>{{ $diplome->reference }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>
                            @if($diplome->isLicence())
                                <span class="badge bg-primary">Licence</span>
                            @elseif($diplome->isMaster())
                                <span class="badge bg-success">Master</span>
                            @elseif($diplome->isDoctorat())
                                <span class="badge bg-warning">Doctorat</span>
                            @else
                                {{ $diplome->type }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Niveau</th>
                        <td>{{ $diplome->niveau ? $diplome->niveau->libelleN : 'Non assigné' }}</td>
                    </tr>
                    <tr>
                        <th>Spécialité</th>
                        <td>{{ $diplome->specialite ?: 'Non spécifié' }}</td>
                    </tr>
                    <tr>
                        <th>Date d'obtention</th>
                        <td>{{ $diplome->dateObtention ? date('d/m/Y', strtotime($diplome->dateObtention)) : 'Non spécifié' }}</td>
                    </tr>
                    @if($diplome->dateRemise)
                    <tr>
                        <th>Date de remise</th>
                        <td>{{ date('d/m/Y', strtotime($diplome->dateRemise)) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Mention</th>
                        <td>{{ $diplome->mention ?: 'Non spécifié' }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <h4>Informations de l'Étudiant</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">Nom</th>
                        <td>{{ $diplome->etudiant->nom }}</td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td>{{ $diplome->etudiant->prenom }}</td>
                    </tr>
                    @if($diplome->etudiant->email)
                    <tr>
                        <th>Email</th>
                        <td>{{ $diplome->etudiant->email }}</td>
                    </tr>
                    @endif
                    @if($diplome->etudiant->telephone)
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $diplome->etudiant->telephone }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Actions</th>
                        <td>
                            <a href="{{ route('etudiants.show', $diplome->etudiant->id) }}" class="btn btn-sm btn-primary rounded-pill">
                                <i class="fas fa-eye"></i> Voir l'étudiant
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Informations spécifiques selon le type de diplôme -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            @if($diplome->isLicence())
                                Informations spécifiques de la Licence
                            @elseif($diplome->isMaster())
                                Informations spécifiques du Master
                            @elseif($diplome->isDoctorat())
                                Informations spécifiques du Doctorat
                            @else
                                Informations complémentaires
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($diplome->isLicence() || $diplome->isMaster())
                            <div class="row">
                                @if($diplome->sujetMemoire)
                                <div class="col-md-12 mb-3">
                                    <h6>Sujet du mémoire</h6>
                                    <p class="p-3 bg-light rounded">{{ $diplome->sujetMemoire }}</p>
                                </div>
                                @endif
                                
                                @if($diplome->encadreur)
                                <div class="col-md-6">
                                    <h6>Encadreur</h6>
                                    <p>{{ $diplome->encadreur }}</p>
                                </div>
                                @endif
                                
                                @if($diplome->isMaster() && $diplome->mentionSpeciale)
                                <div class="col-md-6">
                                    <h6>Mention spéciale</h6>
                                    <p>{{ $diplome->mentionSpeciale }}</p>
                                </div>
                                @endif
                            </div>
                        @elseif($diplome->isDoctorat())
                            <div class="row">
                                @if($diplome->sujetThese)
                                <div class="col-md-12 mb-3">
                                    <h6>Sujet de thèse</h6>
                                    <p class="p-3 bg-light rounded">{{ $diplome->sujetThese }}</p>
                                </div>
                                @endif
                                
                                <div class="col-md-4">
                                    <h6>Directeur de thèse</h6>
                                    <p>{{ $diplome->directeurThese ?: 'Non spécifié' }}</p>
                                </div>
                                
                                <div class="col-md-4">
                                    <h6>Laboratoire</h6>
                                    <p>{{ $diplome->laboratoire ?: 'Non spécifié' }}</p>
                                </div>
                                
                                @if($diplome->mentionSpeciale)
                                <div class="col-md-4">
                                    <h6>Mention spéciale</h6>
                                    <p>{{ $diplome->mentionSpeciale }}</p>
                                </div>
                                @endif
                            </div>
                        @else
                            <p class="text-muted">Aucune information spécifique disponible pour ce type de diplôme.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Professions associées au diplôme -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-briefcase me-2"></i>Professions du diplômé</h5>
                        <a href="{{ route('professions.create', ['diplome_id' => $diplome->id]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter une profession
                        </a>
                    </div>
                    <div class="card-body">
                        @if($diplome->professions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Poste</th>
                                            <th>Structure</th>
                                            <th>Période</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($diplome->professions as $profession)
                                            <tr>
                                                <td>
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
                                                </td>
                                                <td>{{ $profession->poste }}</td>
                                                <td>{{ $profession->structure }}</td>
                                                <td>
                                                    {{ $profession->dateDebut->format('d/m/Y') }} 
                                                    @if($profession->dateFin)
                                                        - {{ $profession->dateFin->format('d/m/Y') }}
                                                    @else
                                                        <span class="badge bg-success">En cours</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('professions.show', $profession->id) }}" class="btn btn-sm btn-info" title="Voir">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('professions.edit', $profession->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('professions.destroy', $profession->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette profession ?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                                <h5>Aucune profession enregistrée</h5>
                                <p class="text-muted">Ce diplômé n'a pas encore de profession enregistrée dans le système.</p>
                                <a href="{{ route('professions.create', ['diplome_id' => $diplome->id]) }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-plus-circle me-2"></i>Ajouter une profession
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
