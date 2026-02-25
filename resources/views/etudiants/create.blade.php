@extends('layouts.app')

@section('title', 'Ajouter un Étudiant')

@section('content')
<div class="card">
    <div class="card-header">
        <!--<h5>Ajouter un Étudiant</h5>-->
    </div>
    <div class="card-body">
        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ine">INE <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ine') is-invalid @enderror" id="ine" name="ine" value="{{ old('ine') }}" required>
                        @error('ine')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dateNaissance">Date de Naissance <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('dateNaissance') is-invalid @enderror" id="dateNaissance" name="dateNaissance" value="{{ old('dateNaissance') }}" required>
                        @error('dateNaissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lieuNaissance">Lieu de Naissance <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lieuNaissance') is-invalid @enderror" id="lieuNaissance" name="lieuNaissance" value="{{ old('lieuNaissance') }}" required>
                        @error('lieuNaissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telephone">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            <div class="col-md-6">
                    <div class="form-group">
            <label for="promotion_id">Promotion</label>
<select class="form-control @error('promotion_id') is-invalid @enderror" id="promotion_id" name="promotion_id">
    <option value="">Sélectionner une promotion</option>
    @foreach($promotions as $promotion)
        <option value="{{ $promotion->id }}" {{ old('promotion_id') == $promotion->id ? 'selected' : '' }}>
            {{ $promotion->idPromotion }} - {{ $promotion->filiere->nomF }}
        </option>
    @endforeach
</select>
                        @error('promotion_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="annee_entree">Année d'entrée <span class="text-danger">*</span></label>
<input type="number" class="form-control mb-2 @error('annee_entree') is-invalid @enderror" id="annee_entree" name="annee_entree" value="{{ old('annee_entree') }}" required min="1900" max="2100">
@error('annee_entree')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                </div>

            <div class="col-md-6">
                <div class="form-group">
<label for="annee_sortie">Année de sortie <span class="text-danger">*</span></label>
<input type="number" class="form-control mb-2 @error('annee_sortie') is-invalid @enderror" id="annee_sortie" name="annee_sortie" value="{{ old('annee_sortie') }}" required min="1900" max="2100">
@error('annee_sortie')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>
            </div>

            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
