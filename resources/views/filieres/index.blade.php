@extends('layouts.app')

@section('title', 'Liste des Filières')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Liste des Filières</h5>
        <a href="{{ route('filieres.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une filière
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Niveau</th>
                        <th>Nombre de Promotions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($filieres as $filiere)
                    <tr>
                        <td>{{ $filiere->id }}</td>
                        <td>{{ $filiere->codeF }}</td>
                        <td>{{ $filiere->nomF }}</td>
                        <td>
                            @if($filiere->niveau)
                                {{ $filiere->niveau->codeN }} - {{ $filiere->niveau->libelleN }}
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </td>
                        <td>{{ $filiere->promotions->count() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('filieres.show', $filiere->id) }}" class="btn btn-sm btn-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('filieres.edit', $filiere->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette filière?');">
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
                        <td colspan="6" class="text-center">Aucune filière trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
