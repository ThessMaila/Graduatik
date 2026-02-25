@extends('layouts.app')

@section('title', 'Modifier une expérience professionnelle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Modifier une expérience professionnelle</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('etudiant.professions.update', $profession) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type d'expérience <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="" disabled {{ old('type', $profession->type) === null ? 'selected' : '' }}>Sélectionnez un type</option>
                                        <option value="Stage" {{ old('type', $profession->type) == 'Stage' ? 'selected' : '' }}>Stage</option>
                                        <option value="Emploi" {{ old('type', $profession->type) == 'Emploi' ? 'selected' : '' }}>Emploi</option>
                                        <option value="Alternance" {{ old('type', $profession->type) == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                                        <option value="Volontariat" {{ old('type', $profession->type) == 'Volontariat' ? 'selected' : '' }}>Volontariat</option>
                                        <option value="Autre" {{ old('type', $profession->type) == 'Autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="poste">Poste <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('poste') is-invalid @enderror" 
                                           id="poste" name="poste" value="{{ old('poste', $profession->poste) }}" required>
                                    @error('poste')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="structure">Entreprise / Structure <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('structure') is-invalid @enderror" 
                                           id="structure" name="structure" value="{{ old('structure', $profession->structure) }}" required>
                                    @error('structure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateDebut">Date de début <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('dateDebut') is-invalid @enderror" 
                                           id="dateDebut" name="dateDebut" value="{{ old('dateDebut', $profession->dateDebut->format('Y-m-d')) }}" required>
                                    @error('dateDebut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateFin">Date de fin</label>
                                    <input type="date" class="form-control @error('dateFin') is-invalid @enderror" 
                                           id="dateFin" name="dateFin" value="{{ old('dateFin', $profession->dateFin ? $profession->dateFin->format('Y-m-d') : '') }}">
                                    <small class="form-text text-muted">Laissez vide si c'est votre poste actuel</small>
                                    @error('dateFin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="secteurActivite">Secteur d'activité <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('secteurActivite') is-invalid @enderror" 
                                           id="secteurActivite" name="secteurActivite" value="{{ old('secteurActivite', $profession->secteurActivite) }}" required>
                                    @error('secteurActivite')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="localisation">Localisation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('localisation') is-invalid @enderror" 
                                           id="localisation" name="localisation" value="{{ old('localisation', $profession->localisation) }}" required>
                                    @error('localisation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label for="description">Description du poste</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $profession->description) }}</textarea>
                                <small class="form-text text-muted">Décrivez vos principales responsabilités et réalisations</small>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('etudiant.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
