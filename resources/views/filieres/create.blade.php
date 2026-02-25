@extends('layouts.app')

@section('title', 'Ajouter une Filière')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Ajouter une Filière</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('filieres.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codeF">Code de la Filière <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('codeF') is-invalid @enderror" id="codeF" name="codeF" value="{{ old('codeF') }}" required>
                        @error('codeF')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nomF">Nom de la Filière <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nomF') is-invalid @enderror" id="nomF" name="nomF" value="{{ old('nomF') }}" required>
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
                                <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
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
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
