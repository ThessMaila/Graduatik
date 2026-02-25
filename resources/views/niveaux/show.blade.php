@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Détails du Niveau</h5>
        <div>
            <a href="{{ route('niveaux.edit', $niveau->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations du Niveau</h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%">Code</th>
                        <td>{{ $niveau->codeN }}</td>
                    </tr>
                    <tr>
                        <th>Libellé</th>
                        <td>{{ $niveau->libelleN }}</td>
                    </tr>
                    <tr>
                        <th>Date de création</th>
                        <td>{{ $niveau->created_at->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Filières associées à ce niveau</h4>
                @if($niveau->filieres->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Nombre de Promotions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($niveau->filieres as $filiere)
                            <tr>
                                <td>{{ $filiere->codeF }}</td>
                                <td>{{ $filiere->nomF }}</td>
                                <td>{{ $filiere->promotions->count() }}</td>
                                <td>
                                    <a href="{{ route('filieres.show', $filiere->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucune filière associée à ce niveau.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
