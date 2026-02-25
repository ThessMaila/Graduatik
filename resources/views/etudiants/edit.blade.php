@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header">
        <h5>Modifier un Étudiant</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ine">INE <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ine') is-invalid @enderror" id="ine" name="ine" value="{{ old('ine', $etudiant->ine) }}" required>
                        @error('ine')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $etudiant->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telephone">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required>
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dateNaissance">Date de Naissance <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('dateNaissance') is-invalid @enderror" id="dateNaissance" name="dateNaissance" value="{{ old('dateNaissance', $etudiant->dateNaissance) }}" required>
                        @error('dateNaissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lieuNaissance">Lieu de Naissance <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lieuNaissance') is-invalid @enderror" id="lieuNaissance" name="lieuNaissance" value="{{ old('lieuNaissance', $etudiant->lieuNaissance) }}" required>
                        @error('lieuNaissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="promotion_id">Ajouter à une promotion</label>
                        <select class="form-control @error('promotion_id') is-invalid @enderror" id="promotion_id" name="promotion_id">
                            <option value="">Sélectionner une promotion</option>
                            @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}" {{ old('promotion_id') == $promotion->id ? 'selected' : '' }}>
                                    {{ $promotion->idPromotion }} - {{ $promotion->filiere->nomF }} ({{ $promotion->anneeDebut }}-{{ $promotion->anneeFin }})
                                </option>
                            @endforeach
                        </select>
                        @error('promotion_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Promotions actuelles</h5>
    </div>
    <div class="card-body">
        @if($etudiant->promotions->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Promotion</th>
                        <th>Filière</th>
                        <th>Période</th>
                        <th>Date d'Intégration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiant->promotions as $promotion)
                    <tr>
                        <td>{{ $promotion->idPromotion }}</td>
                        <td>{{ $promotion->filiere->nomF }}</td>
                        <td>{{ $promotion->anneeDebut }} - {{ $promotion->anneeFin }}</td>
                        <td>{{ $promotion->pivot->dateIntegration }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Aucune promotion associée.</p>
        @endif
    </div>
</div>
@endsection
