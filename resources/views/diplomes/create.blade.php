@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header">
        <h5>Ajouter un Diplôme</h5>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('diplomes.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reference">Référence du Diplôme <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" value="{{ old('reference') }}" placeholder="Ex: DIPL-2025-001" required>
                        @error('reference')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="etudiant_id">Étudiant <span class="text-danger">*</span></label>
                        <select class="form-control @error('etudiant_id') is-invalid @enderror" id="etudiant_id" name="etudiant_id" required>
                            <option value="">Sélectionner un étudiant</option>
                            @foreach($etudiants as $etudiant)
                                <option value="{{ $etudiant->id }}" {{ old('etudiant_id') == $etudiant->id ? 'selected' : '' }}>
                                    {{ $etudiant->nom }} {{ $etudiant->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('etudiant_id')
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
            
            <!--<div class="row mb-3">
                <div class="col-md-4">
                    
                </div>-->
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dateObtention">Date d'obtention <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('dateObtention') is-invalid @enderror" id="dateObtention" name="dateObtention" value="{{ old('dateObtention') }}" required>
                            @error('dateObtention')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                <!--<div class="col-md-4">
                    <div class="form-group">
                        <label for="dateRemise">Date de remise</label>
                        <input type="date" class="form-control @error('dateRemise') is-invalid @enderror" id="dateRemise" name="dateRemise" value="{{ old('dateRemise') }}">
                        @error('dateRemise')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>-->
            
            <div class="col-md-8">
                <div class="form-group">
                    <label for="specialite">Spécialité</label>
                        <input type="text" class="form-control @error('specialite') is-invalid @enderror" id="specialite" name="specialite" value="{{ old('specialite') }}">
                        @error('specialite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
            </div>
        </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mention">Mention</label>
                        <select class="form-control @error('mention') is-invalid @enderror" id="mention" name="mention">
                            <option value="">Sélectionner une mention</option>
                            <option value="Passable" {{ old('mention') == 'Passable' ? 'selected' : '' }}>Passable</option>
                            <option value="Assez Bien" {{ old('mention') == 'Assez Bien' ? 'selected' : '' }}>Assez Bien</option>
                            <option value="Bien" {{ old('mention') == 'Bien' ? 'selected' : '' }}>Bien</option>
                            <option value="Très Bien" {{ old('mention') == 'Très Bien' ? 'selected' : '' }}>Très Bien</option>
                            <option value="Excellent" {{ old('mention') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                        </select>
                        @error('mention')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Champs spécifiques pour Licence et Master -->
            <div id="memoire-fields" class="row mb-3" style="display: none;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sujetMemoire">Sujet du mémoire <span class="text-danger licence-master-required">*</span></label>
                        <textarea class="form-control @error('sujetMemoire') is-invalid @enderror" id="sujetMemoire" name="sujetMemoire" rows="3">{{ old('sujetMemoire') }}</textarea>
                        @error('sujetMemoire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!--<div class="col-md-6">
                    <div class="form-group">
                        <label for="encadreur">Encadreur <span class="text-danger licence-master-required">*</span></label>
                        <input type="text" class="form-control @error('encadreur') is-invalid @enderror" id="encadreur" name="encadreur" value="{{ old('encadreur') }}">
                        @error('encadreur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>-->
            </div>
            
            <!-- Champs spécifiques pour Doctorat -->
            <div id="these-fields" class="row mb-3" style="display: none;">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="sujetThese">Sujet de thèse <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('sujetThese') is-invalid @enderror" id="sujetThese" name="sujetThese" rows="3">{{ old('sujetThese') }}</textarea>
                        @error('sujetThese')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="directeurThese">Directeur de thèse <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('directeurThese') is-invalid @enderror" id="directeurThese" name="directeurThese" value="{{ old('directeurThese') }}">
                        @error('directeurThese')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!--<div class="col-md-6">
                    <div class="form-group">
                        <label for="laboratoire">Laboratoire <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('laboratoire') is-invalid @enderror" id="laboratoire" name="laboratoire" value="{{ old('laboratoire') }}">
                        @error('laboratoire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>-->
            </div>
            
            <!-- Mention spéciale pour Master et Doctorat -->
            <div id="mention-speciale-field" class="row mb-3" style="display: none;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="mentionSpeciale">Mention spéciale</label>
                        <input type="text" class="form-control @error('mentionSpeciale') is-invalid @enderror" id="mentionSpeciale" name="mentionSpeciale" value="{{ old('mentionSpeciale') }}" placeholder="Ex: Félicitations du jury">
                        @error('mentionSpeciale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('diplomes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Fonction pour afficher/masquer les champs en fonction du type de diplôme
        function toggleFields() {
            const type = $('#type').val();
            
            // Masquer tous les champs spécifiques
            $('#memoire-fields').hide();
            $('#these-fields').hide();
            $('#mention-speciale-field').hide();
            
            // Afficher les champs appropriés selon le type
            if (type === '{{ App\Models\Diplome::TYPE_LICENCE }}') {
                $('#memoire-fields').show();
                $('.licence-master-required').hide(); // Champs optionnels pour Licence
            } else if (type === '{{ App\Models\Diplome::TYPE_MASTER }}') {
                $('#memoire-fields').show();
                $('#mention-speciale-field').show();
                $('.licence-master-required').show(); // Champs obligatoires pour Master
            } else if (type === '{{ App\Models\Diplome::TYPE_DOCTORAT }}') {
                $('#these-fields').show();
                $('#mention-speciale-field').show();
            }
        }
        
        // Exécuter au chargement de la page
        toggleFields();
        
        // Exécuter à chaque changement du type de diplôme
        $('#type').change(toggleFields);
    });
</script>
@endsection
