@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Ajouter une Promotion</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('promotions.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="idPromotion">ID Promotion <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('idPromotion') is-invalid @enderror" id="idPromotion" name="idPromotion" value="{{ old('idPromotion') }}" placeholder="Ex: INFO-2025" required>
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
                                <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
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
            
            
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('promotions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
