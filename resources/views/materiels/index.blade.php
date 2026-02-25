@extends('layouts.app')

@section('title', 'Liste des Matériels')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Liste des Matériels</h5>
        <a href="{{ route('materiels.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un matériel
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Désignation</th>
                        <th>Quantité Disponible</th>
                        <th>Nombre d'Étudiants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materiels as $materiel)
                    <tr>
                        <td>{{ $materiel->id }}</td>
                        <td>{{ $materiel->reference }}</td>
                        <td>{{ $materiel->designation }}</td>
                        <td>{{ $materiel->quantite }}</td>
                        <td>{{ $materiel->etudiants->count() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('materiels.show', $materiel->id) }}" class="btn btn-sm btn-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('materiels.edit', $materiel->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('materiels.destroy', $materiel->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce matériel?');">
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
                        <td colspan="6" class="text-center">Aucun matériel trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
