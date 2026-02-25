@extends('layouts.app')

@section('title', 'Liste complète des professions par étudiant')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <!--<h1 class="h3 mb-0">Liste complète des professions</h1>-->
            <a href="{{ route('professions.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour aux mises à jour
            </a>
        </div>
    </div>
    <div class="card animate-fade-in">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="w-15">Nom</th>
<th class="w-15">Prénom</th>
<th class="w-10">INE</th>
<th class="w-15">Promotion</th>
<th class="w-15">Profession</th>
<!-- <th class="w-10">Statut</th> -->
<th style="width:120px; min-width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                
                                <td>{{ $etudiant->ine }}</td>
                                @php
    $promotion = $etudiant->promotions->sortByDesc(function($promo) {
        return optional($promo->pivot)->dateIntegration;
    })->first();
@endphp
<td>
    @if($promotion)
        {{ $promotion->anneeDebut ?? '-' }}-{{ $promotion->anneeFin ?? '-' }}
        @if($promotion->filiere)
            ({{ $promotion->filiere->nomF ?? '' }})
        @endif
    @else
        -
    @endif
</td>
                                @if($etudiant->professions->count() > 0)
    @php $profession = $etudiant->professions->sortByDesc('created_at')->first(); @endphp
    <td>{{ $profession->poste }}</td>
    <td>
        <a href="{{ route('professions.show', $profession->id) }}" class="btn btn-sm btn-info me-1" title="Voir">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('professions.edit', $profession->id) }}" class="btn btn-sm btn-warning me-1" title="Modifier">
            <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('professions.destroy', $profession->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette profession ?')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </td>
@else
    <td class="text-muted">Aucun</td>
    <td>
        <a href="{{ route('professions.create', ['diplome_id' => $etudiant->diplomes->first()->id ?? null]) }}" class="btn btn-sm btn-success" title="Ajouter un parcours">
            <i class="fas fa-plus"></i> Ajouter
        </a>
    </td>
@endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
