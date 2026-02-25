@extends('layouts.app')

@section('title', 'Modifier une Filière')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Modifier une Filière</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('filieres.update', $filiere->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codeF">Code de la Filière <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('codeF') is-invalid @enderror" id="codeF" name="codeF" value="{{ old('codeF', $filiere->codeF) }}" required>
                        @error('codeF')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nomF">Nom de la Filière <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nomF') is-invalid @enderror" id="nomF" name="nomF" value="{{ old('nomF', $filiere->nomF) }}" required>
                        @error('nomF')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="niveau_id">Niveau <span class="text-danger">*</span></label>
                        <select class="form-control @error('niveau_id') is-invalid @enderror" id="niveau_id" name="niveau_id" required>
                            <option value="">Sélectionner un niveau</option>
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau->id }}" {{ (old('niveau_id', $filiere->niveau_id) == $niveau->id) ? 'selected' : '' }}>
                                    {{ $niveau->codeN }} - {{ $niveau->libelleN }}
                                </option>
                            @endforeach
                        </select>
                        @error('niveau_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Promotions associées</h5>
    </div>
    <div class="card-body">
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
@endsection
