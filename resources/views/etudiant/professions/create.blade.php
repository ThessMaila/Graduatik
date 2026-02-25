@extends('layouts.app')

@section('title', 'Ajouter une expérience professionnelle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ajouter une expérience professionnelle</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('etudiant.professions.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type d'expérience <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
    <option value="" disabled {{ old('type') === null ? 'selected' : '' }}>Sélectionnez un type</option>
    @foreach(\App\Models\Profession::TYPES as $type)
        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
    @endforeach
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
                                           id="poste" name="poste" value="{{ old('poste') }}" required>
                                    @error('poste')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="structure">Entreprise / Structure <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('structure') is-invalid @enderror" 
                                           id="structure" name="structure" value="{{ old('structure') }}" required>
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
                                           id="dateDebut" name="dateDebut" value="{{ old('dateDebut') }}" required>
                                    @error('dateDebut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateFin">Date de fin</label>
                                    <input type="date" class="form-control @error('dateFin') is-invalid @enderror" 
                                           id="dateFin" name="dateFin" value="{{ old('dateFin') }}">
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
                                           id="secteurActivite" name="secteurActivite" value="{{ old('secteurActivite') }}" required>
                                    @error('secteurActivite')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="localisation">Localisation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('localisation') is-invalid @enderror" 
                                           id="localisation" name="localisation" value="{{ old('localisation') }}" required>
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
                                          id="description" name="description" rows="4">{{ old('description') }}</textarea>
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
                                <i class="fas fa-save me-1"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
