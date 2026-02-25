@extends('layouts.app')

@section('title', 'Gestion des Professions')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="d-flex align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Liste des mises à jour professionnelles</h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-end align-items-center gap-2">
                <a href="{{ route('professions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Ajouter une profession
                </a>
                <a href="{{ route('admin.professions.liste') }}" class="btn btn-outline-primary">
                    <i class="fas fa-list me-2"></i>Liste des professions
                </a>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4 animate-fade-in">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filtres</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('professions.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="type" class="form-label">Type de profession</label>
                    <select name="type" id="type" class="form-select">
                        <option value="">Tous les types</option>
                        <option value="Stage" {{ request('type') == 'Stage' ? 'selected' : '' }}>Stage</option>
                        <option value="CDD" {{ request('type') == 'CDD' ? 'selected' : '' }}>CDD</option>
                        <option value="CDI" {{ request('type') == 'CDI' ? 'selected' : '' }}>CDI</option>
                        <option value="Freelance" {{ request('type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="Autre" {{ request('type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="structure" class="form-label">Structure/Entreprise</label>
                    <input type="text" class="form-control" id="structure" name="structure" value="{{ request('structure') }}">
                </div>
                <div class="col-md-3">
                    <label for="diplome_id" class="form-label">Diplôme</label>
                    <select name="diplome_id" id="diplome_id" class="form-select">
                        <option value="">Tous les diplômes</option>
                        @foreach(\App\Models\Diplome::with('etudiant')->get() as $diplome)
                            <option value="{{ $diplome->id }}" {{ request('diplome_id') == $diplome->id ? 'selected' : '' }}>
                                {{ $diplome->etudiant->nom }} {{ $diplome->etudiant->prenom }} - {{ $diplome->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-2"></i>Filtrer
                    </button>
                    <a href="{{ route('professions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des professions -->
    <div class="card shadow animate-fade-in">
        <div class="card-body">
            @if($professions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Diplômé</th>
                                <th>Type</th>
                                <th>Poste</th>
                                <th>Structure</th>
                                <th>Période</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($professions as $profession)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <strong>{{ $profession->etudiant->nom ?? '' }} {{ $profession->etudiant->prenom ?? '' }}</strong>
                                            </div>
                                        </div>
                                    </td>
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
                <div class="mt-4">
                    {{ $professions->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
                    <h4>Aucune profession trouvée</h4>
                    <p class="text-muted">Aucune profession n'a été enregistrée ou ne correspond aux critères de recherche.</p>
                    <a href="{{ route('professions.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter une profession
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
