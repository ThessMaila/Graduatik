@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Modifier un Diplôme</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('diplomes.update', $diplome->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reference">Référence du Diplôme <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" value="{{ old('reference', $diplome->reference) }}" required>
                        @error('reference')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="etudiant_id">Étudiant <span class="text-danger">*</span></label>
                        <select class="form-control @error('etudiant_id') is-invalid @enderror" id="etudiant_id" name="etudiant_id" required>
                            <option value="">Sélectionner un étudiant</option>
                            @foreach($etudiants as $etudiant)
                                <option value="{{ $etudiant->id }}" {{ (old('etudiant_id', $diplome->etudiant_id) == $etudiant->id) ? 'selected' : '' }}>
                                    {{ $etudiant->nom }} {{ $etudiant->prenom }} ({{ $etudiant->matricule }})
                                </option>
                            @endforeach
                        </select>
                        @error('etudiant_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
    <div class="form-group">
        <label for="niveau_id">Niveau <span class="text-danger">*</span></label>
        <select class="form-control @error('niveau_id') is-invalid @enderror" id="niveau_id" name="niveau_id" required>
            <option value="">Sélectionner un niveau</option>
            @foreach($niveaux as $niveau)
                <option value="{{ $niveau->id }}" data-libellen="{{ $niveau->libelleN }}" {{ (old('niveau_id', $diplome->niveau_id) == $niveau->id) ? 'selected' : '' }}>
                    {{ $niveau->libelleN }}
                </option>
            @endforeach
        </select>
        @error('niveau_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="type">Type de Diplôme</label>
        <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $diplome->type) }}" readonly>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTypeField() {
            var niveauSelect = document.getElementById('niveau_id');
            var typeInput = document.getElementById('type');
            var selectedOption = niveauSelect.options[niveauSelect.selectedIndex];
            var libelle = selectedOption.getAttribute('data-libellen') || '';
            var type = '';
            if (libelle.toLowerCase().includes('licence')) {
                type = 'Licence';
            } else if (libelle.toLowerCase().includes('master')) {
                type = 'Master';
            } else if (libelle.toLowerCase().includes('doctorat')) {
                type = 'Doctorat';
            }
            typeInput.value = type;
        }
        document.getElementById('niveau_id').addEventListener('change', updateTypeField);
        updateTypeField(); // Initialiser au chargement
    });
</script>
@endpush
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dateObtention">Date d'obtention <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('dateObtention') is-invalid @enderror" id="dateObtention" name="dateObtention" value="{{ old('dateObtention', $diplome->dateObtention) }}" required>
                        @error('dateObtention')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('diplomes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
