@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Modifier un Niveau</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('niveaux.update', $niveau->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">Type du Niveau <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $niveau->type) }}" required>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Description du Niveau <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description', $niveau->description) }}" required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Filières associées</h5>
    </div>
    <div class="card-body">
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
@endsection
