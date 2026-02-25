@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Liste des Promotions</h5>
        <a href="{{ route('promotions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une promotion
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Promotion</th>
                        <th>Filière</th>
                        <!--<th>Période</th>-->
                        <th>Nombre d'Étudiants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promotions as $promotion)
                    <tr>
                        <td>{{ $promotion->id }}</td>
                        <td>{{ $promotion->idPromotion }}</td>
                        <td>{{ $promotion->filiere->nomF }}</td>
                        <!--<td>{{ $promotion->anneeDebut }} - {{ $promotion->anneeFin }}</td>-->
                        <td>{{ $promotion->etudiants->count() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-sm btn-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion?');">
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
                        <td colspan="6" class="text-center">Aucune promotion trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
