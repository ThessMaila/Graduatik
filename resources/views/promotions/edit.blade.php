@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Modifier une Promotion</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="idPromotion">ID Promotion <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('idPromotion') is-invalid @enderror" id="idPromotion" name="idPromotion" value="{{ old('idPromotion', $promotion->idPromotion) }}" required>
                        @error('idPromotion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="filiere_id">Filière <span class="text-danger">*</span></label>
                        <select class="form-control @error('filiere_id') is-invalid @enderror" id="filiere_id" name="filiere_id" required>
                            <option value="">Sélectionner une filière</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ (old('filiere_id', $promotion->filiere_id) == $filiere->id) ? 'selected' : '' }}>
                                    {{ $filiere->codeF }} - {{ $filiere->nomF }}
                                </option>
                            @endforeach
                        </select>
                        @error('filiere_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="anneeDebut">Année de début <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('anneeDebut') is-invalid @enderror" id="anneeDebut" name="anneeDebut" value="{{ old('anneeDebut', $promotion->anneeDebut) }}" required>
                        @error('anneeDebut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="anneeFin">Année de fin <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('anneeFin') is-invalid @enderror" id="anneeFin" name="anneeFin" value="{{ old('anneeFin', $promotion->anneeFin) }}" required>
                        @error('anneeFin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('promotions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Étudiants de la Promotion</h5>
    </div>
    <div class="card-body">
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
@endsection
