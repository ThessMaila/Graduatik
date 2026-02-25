@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Détails de l'Étudiant</h5>
        <div>
            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations Personnelles</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">Nom</th>
                        <td>{{ $etudiant->nom }}</td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td>{{ $etudiant->prenom }}</td>
                    </tr>
                    <tr>
                        <th>INE</th>
                        <td>{{ $etudiant->ine }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $etudiant->email }}</td>
                    </tr>
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $etudiant->telephone }}</td>
                    </tr>
                    <tr>
                        <th>Date de Naissance</th>
                        <td>{{ $etudiant->dateNaissance }}</td>
                    </tr>
                    <tr>
                        <th>Lieu de Naissance</th>
                        <td>{{ $etudiant->lieuNaissance }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <h4>Promotions</h4>
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
        
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Diplômes</h4>
                @if($etudiant->diplomes->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Niveau</th>
                                <th>Date d'Obtention</th>
                                <th>Mention</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiant->diplomes as $diplome)
                            <tr>
                                <td>{{ $diplome->type }}</td>
                                <td>{{ $diplome->niveau->type }}</td>
                                <td>{{ $diplome->dateObtention }}</td>
                                <td>{{ $diplome->mention }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucun diplôme associé.</p>
                @endif
            </div>
        </div>
        

    </div>
</div>
@endsection
