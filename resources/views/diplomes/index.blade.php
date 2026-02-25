@extends('layouts.app')

@section('title', 'Liste des Diplômés')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!--<h5>Liste des Diplômés</h5>-->
        <a href="{{ route('diplomes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un diplôme
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Étudiant</th>
                        <th>Type</th>
                        <th>Date d'obtention</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($diplomes as $diplome)
                    <tr>
                        <td>{{ $diplome->id }}</td>
                        <td>{{ $diplome->reference }}</td>
                        <td>{{ $diplome->etudiant->nom }} {{ $diplome->etudiant->prenom }}</td>
                        <td>{{ $diplome->type }}</td>
                        <td>{{ $diplome->dateObtention }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('diplomes.show', $diplome->id) }}" class="btn btn-sm btn-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('diplomes.edit', $diplome->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('diplomes.destroy', $diplome->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce diplôme?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun diplôme trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
