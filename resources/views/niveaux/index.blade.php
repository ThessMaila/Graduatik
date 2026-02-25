@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Liste des Niveaux</h5>
        <a href="{{ route('niveaux.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un niveau
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Libellé</th>
                        <th>Nombre de Filières</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($niveaux as $niveau)
                    <tr>
                        <td>{{ $niveau->id }}</td>
                        <td>{{ $niveau->codeN }}</td>
                        <td>{{ $niveau->libelleN }}</td>
                        <td>{{ $niveau->filieres->count() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('niveaux.show', $niveau->id) }}" class="btn btn-sm btn-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('niveaux.edit', $niveau->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('niveaux.destroy', $niveau->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce niveau?');">
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
                        <td colspan="5" class="text-center">Aucun niveau trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
