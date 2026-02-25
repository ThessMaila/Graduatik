@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container-fluid px-4">
    <!-- Bannière d'accueil -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg rounded-lg animate-fade-in">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="fw-bold mb-3 animate-slide-up">Bienvenue sur Graduatik</h2>
                            <p class="lead text-muted animate-slide-up" style="animation-delay: 0.2s">Application de gestion des sortants de l'Institut Burkinabè des Arts et Métiers (IBAM)</p>
                            <div class="mt-4 animate-slide-up" style="animation-delay: 0.3s">
                                @auth('etudiant')
                                    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-primary me-2">
                                        <i class="fas fa-tachometer-alt me-2"></i>Mon tableau de bord
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                                        <i class="fas fa-sign-in-alt me-2"></i>Connexion Étudiant
                                    </a>
                                    <a href="{{ route('etudiants.create') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-user-plus me-2"></i>Ajouter un étudiant
                                    </a>
                                @endauth
                                <a href="{{ route('diplomes.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-graduation-cap me-2"></i>Ajouter un diplôme
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 d-none d-md-block text-center">
                            <i class="fas fa-university fa-6x text-primary opacity-50 animate__animated animate__fadeIn"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->    
    <div class="row mb-4">
        <div class="col-md-3 mb-3" style="animation-delay: 0.1s">
            <div class="stat-card bg-gradient-primary animate-slide-up">
                <div class="icon float-end">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="count">{{ \App\Models\Etudiant::count() }}</div>
                <div class="title">Étudiants</div>
                <a href="{{ route('etudiants.index') }}" class="stretched-link"></a>
            </div>
        </div>
        
        <div class="col-md-3 mb-3" style="animation-delay: 0.2s">
            <div class="stat-card bg-gradient-success animate-slide-up">
                <div class="icon float-end">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="count">{{ \App\Models\Diplome::count() }}</div>
                <div class="title">Diplômes</div>
                <a href="{{ route('diplomes.index') }}" class="stretched-link"></a>
            </div>
        </div>
        
        <div class="col-md-3 mb-3" style="animation-delay: 0.3s">
            <div class="stat-card bg-gradient-info animate-slide-up">
                <div class="icon float-end">
                    <i class="fas fa-book"></i>
                </div>
                <div class="count">{{ \App\Models\Filiere::count() }}</div>
                <div class="title">Filières</div>
                <a href="{{ route('filieres.index') }}" class="stretched-link"></a>
            </div>
        </div>
        
        <div class="col-md-3 mb-3" style="animation-delay: 0.4s">
            <div class="stat-card bg-gradient-warning animate-slide-up">
                <div class="icon float-end">
                    <i class="fas fa-users"></i>
                </div>
                <div class="count">{{ \App\Models\Promotion::count() }}</div>
                <div class="title">Promotions</div>
                <a href="{{ route('promotions.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Accès rapides -->    
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm animate-fade-in" style="animation-delay: 0.5s">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <i class="fas fa-bolt me-2"></i>
                    <h5 class="mb-0">Accès rapides</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('etudiants.create') }}" class="btn btn-outline-primary w-100 p-3 rounded-lg transition-all h-100">
                                <i class="fas fa-user-plus fa-2x mb-2"></i>
                                <div>Ajouter un étudiant</div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('diplomes.create') }}" class="btn btn-outline-success w-100 p-3 rounded-lg transition-all h-100">
                                <i class="fas fa-award fa-2x mb-2"></i>
                                <div>Ajouter un diplôme</div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('filieres.create') }}" class="btn btn-outline-info w-100 p-3 rounded-lg transition-all h-100">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <div>Ajouter une filière</div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('promotions.create') }}" class="btn btn-outline-warning w-100 p-3 rounded-lg transition-all h-100">
                                <i class="fas fa-user-friends fa-2x mb-2"></i>
                                <div>Ajouter une promotion</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Derniers ajouts -->    
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm animate-fade-in" style="animation-delay: 0.6s">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-user-graduate text-primary me-2"></i>
                    <h5 class="mb-0">Derniers étudiants ajoutés</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nom</th>
                                    <th>Prénom</th>
                                    <th class="text-end pe-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Etudiant::latest()->take(5)->get() as $etudiant)
                                <tr>
                                    <td class="ps-3">{{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->prenom }}</td>
                                    <td class="text-end pe-3">
                                        <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-primary rounded-pill">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">Aucun étudiant trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="{{ route('etudiants.index') }}" class="btn btn-sm btn-link text-primary">Voir tous les étudiants <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Derniers diplômes ajoutés -->    
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm animate-fade-in" style="animation-delay: 0.7s">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-graduation-cap text-success me-2"></i>
                    <h5 class="mb-0">Derniers diplômes ajoutés</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Référence</th>
                                    <th>Type</th>
                                    <th class="text-end pe-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Diplome::latest()->take(5)->get() as $diplome)
                                <tr>
                                    <td class="ps-3">{{ $diplome->reference }}</td>
                                    <td>{{ $diplome->type }}</td>
                                    <td class="text-end pe-3">
                                        <a href="{{ route('diplomes.show', $diplome->id) }}" class="btn btn-sm btn-success rounded-pill">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">Aucun diplôme trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="{{ route('diplomes.index') }}" class="btn btn-sm btn-link text-success">Voir tous les diplômes <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistiques par niveau -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm animate-fade-in" style="animation-delay: 0.8s">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-chart-bar text-info me-2"></i>
                    <h5 class="mb-0">Répartition par niveau</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach(\App\Models\Niveau::withCount('filieres')->get() as $niveau)
                        <div class="col-md-4 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fw-bold">{{ $niveau->libelleN }}</h6>
                                            <p class="mb-0">{{ $niveau->filieres_count }} filière(s)</p>
                                        </div>
                                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                            <i class="fas fa-layer-group text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
