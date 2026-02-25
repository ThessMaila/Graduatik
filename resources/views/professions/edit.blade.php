@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('professions.index') }}">Professions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier une profession</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow animate-fade-in">
        <div class="card-header bg-gradient-warning text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier la profession</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('professions.update', $profession->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-primary">Informations générales</h6>
                        <hr>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Étudiant</label>
<input type="text" class="form-control" value="{{ $profession->etudiant->nom ?? '' }} {{ $profession->etudiant->prenom ?? '' }}" readonly>
<input type="hidden" name="etudiant_id" value="{{ $profession->etudiant_id }}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Type de profession <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">Sélectionner un type</option>
                                @foreach(\App\Models\Profession::TYPES as $type)
                                    <option value="{{ $type }}" {{ old('type', $profession->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="poste" class="form-label">Poste occupé <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('poste') is-invalid @enderror" id="poste" name="poste" value="{{ old('poste', $profession->poste) }}" required>
                            @error('poste')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="structure" class="form-label">Structure/Entreprise <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('structure') is-invalid @enderror" id="structure" name="structure" value="{{ old('structure', $profession->structure) }}" required>
                            @error('structure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-primary">Période</h6>
                        <hr>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="dateDebut" class="form-label">Date de début <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('dateDebut') is-invalid @enderror" id="dateDebut" name="dateDebut" value="{{ old('dateDebut', $profession->dateDebut->format('Y-m-d')) }}" required>
                            @error('dateDebut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="dateFin" class="form-label">Date de fin <small class="text-muted">(laisser vide si en cours)</small></label>
                            <input type="date" class="form-control @error('dateFin') is-invalid @enderror" id="dateFin" name="dateFin" value="{{ old('dateFin', $profession->dateFin ? $profession->dateFin->format('Y-m-d') : '') }}">
                            @error('dateFin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="text-primary">Informations complémentaires</h6>
                        <hr>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description du poste</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $profession->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('professions.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i>Mettre à jour
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
