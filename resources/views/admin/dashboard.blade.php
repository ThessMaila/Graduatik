@extends('layouts.app')

@section('title', 'Tableau de Bord Administrateur')

@section('content')


<style>
    body, .dashboard-bg {
        background: linear-gradient(135deg, #f8fafc 0%, #e3e9f7 100%) !important;
    }
    .admin-header {
        background: linear-gradient(90deg, #3b82f6 0%, #6366f1 100%);
        color: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 24px rgba(59,130,246,0.08);
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .admin-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(59,130,246,0.11);
        margin-right: 1.5rem;
    }
    .admin-header-content h2 {
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .admin-header-content p {
        margin-bottom: 0;
        opacity: 0.9;
    }
    .admin-logout {
        margin-left: 2rem;
    }
    .stat-card {
        border-radius: 1rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        background: #fff;
        padding: 1.5rem 1rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .stat-card i {
        font-size: 2.2rem;
        margin-bottom: 0.7rem;
    }
    .stat-card .stat-value {
        font-size: 2.1rem;
        font-weight: 700;
        line-height: 1.1;
    }
    .stat-card .stat-label {
        font-size: 1.07rem;
        color: #6366f1;
        font-weight: 500;
    }
    .quick-action-btn {
        min-height: 120px;
        max-height: 120px;
        justify-content: center;
        border-width: 2px;
        transition: transform 0.13s, box-shadow 0.13s;
        border-radius: 1rem;
        font-size: 1.07rem;
        font-weight: 500;
        background: #fff;
    }
    .quick-action-btn:hover {
        transform: translateY(-4px) scale(1.045);
        box-shadow: 0 0.5rem 1.2rem rgba(99,102,241,0.13);
        z-index: 2;
        background: #f1f5ff;
    }
    .quick-action-btn i {
        margin-bottom: 0.5rem;
        font-size: 2rem;
    }
    .quick-action-btn span {
        font-size: 1.05rem;
        font-weight: 500;
    }
    .section-title {
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 1rem;
        letter-spacing: 0.01em;
    }
    .recent-actions {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        padding: 1.5rem 1rem;
        margin-top: 2rem;
    }
</style>
<div class="dashboard-bg">
    <!-- Notifications -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-2">
            <div>
                @if($notifications->count() > 0)
                    <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-check-double me-1"></i>Tout marquer comme lu
                        </button>
                    </form>
                @endif
            </div>
            <div class="dropdown">
                <button class="btn btn-light position-relative" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fa-lg"></i>
                    @if(isset($notifications) && count($notifications) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($notifications) }}
                        </span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notifDropdown" style="min-width:340px;">
                    <li class="dropdown-header fw-bold text-primary">Notifications</li>
                    @if(isset($notifications) && count($notifications) > 0)
                        @foreach($notifications as $notif)
                            <li class="dropdown-item small">
                                <a href="{{ isset($notif->profession) ? route('professions.edit', $notif->profession->id) : '#' }}" class="text-decoration-none">
                                    <div class="fw-bold">{{ $notif->message }}</div>
                                    @if(isset($notif->profession) && $notif->etudiant)
                                        <div class="small text-dark mt-1">
                                            <strong>Étudiant :</strong> {{ $notif->etudiant->prenom }} {{ $notif->etudiant->nom }}<br>
                                            <strong>Poste :</strong> {{ $notif->profession->poste ?? '-' }}<br>
                                            <strong>Structure :</strong> {{ $notif->profession->structure ?? '-' }}<br>
                                            <strong>Type :</strong> {{ $notif->profession->type ?? '-' }}<br>
                                            <strong>Période :</strong> {{ $notif->profession->dateDebut ? \Carbon\Carbon::parse($notif->profession->dateDebut)->format('d/m/Y') : '-' }} @if($notif->profession->dateFin) - {{ \Carbon\Carbon::parse($notif->profession->dateFin)->format('d/m/Y') }} @endif<br>
                                            <strong>Description :</strong> {{ $notif->profession->description ?? '-' }}
                                        </div>
                                    @endif
                                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="dropdown-item text-muted">Aucune nouvelle notification.</li>
                    @endif
                </ul>
                
            </div>
        </div>
    </div>
    <!-- En-tête admin -->
    <div class="admin-header">
        <div class="d-flex align-items-center">
            <div class="admin-avatar" style="font-size:2.2rem; font-weight:700; color:#3b82f6; background:#fff; display:flex; align-items:center; justify-content:center;">
                A
            </div>
            <div class="admin-header-content">
                <h2>Bienvenue, Administrateur</h2>
                <p class="mb-0">Gérez facilement les diplômés, promotions et plus encore</p>
            </div>
        </div>
        <!-- <form method="POST" action="{{ route('logout') }}" class="admin-logout">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-sign-out-alt me-2"></i>Se déconnecter
            </button>
        </form> -->
    </div>

    <!-- Statistiques principales -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm animate-fade-in">
                <div class="card-header bg-light d-flex align-items-center">
                    <i class="fas fa-chart-bar fa-lg text-primary me-2"></i>
                    <span class="fw-semibold">Statistiques</span>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="stat-box p-3 rounded bg-primary bg-opacity-10">
                                <i class="fas fa-user-graduate fa-2x text-primary mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ $etudiantsCount ?? '...' }}</h4>
                                <span class="text-muted">Étudiants</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="stat-box p-3 rounded bg-success bg-opacity-10">
                                <i class="fas fa-graduation-cap fa-2x text-success mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ $diplomesCount ?? '...' }}</h4>
                                <span class="text-muted">Diplômes</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box p-3 rounded bg-info bg-opacity-10">
                                <i class="fas fa-users fa-2x text-info mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ $promotionsCount ?? '...' }}</h4>
                                <span class="text-muted">Promotions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accès rapides -->
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <h4 class="section-title"><i class="fas fa-bolt me-2"></i>Accès rapides</h4>
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6 col-xl-3 d-flex">
                    <a href="{{ route('etudiants.create') }}" class="btn btn-outline-primary w-100 quick-action-btn d-flex flex-column align-items-center justify-content-center p-4">
                        <i class="fas fa-user-plus fa-3x mb-2"></i>
                        <span class="fs-5">Ajouter étudiant</span>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3 d-flex">
                    <a href="{{ route('promotions.create') }}" class="btn btn-outline-info w-100 quick-action-btn d-flex flex-column align-items-center justify-content-center p-4">
                        <i class="fas fa-users fa-3x mb-2"></i>
                        <span class="fs-5">Ajouter promotion</span>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3 d-flex">
                    <a href="{{ route('diplomes.create') }}" class="btn btn-outline-success w-100 quick-action-btn d-flex flex-column align-items-center justify-content-center p-4">
    <i class="fas fa-graduation-cap fa-3x mb-2"></i>
    <span class="fs-5">Ajouter diplôme</span>
</a>
                </div>
                <div class="col-12 col-md-6 col-xl-3 d-flex">
                    <a href="{{ route('professions.create') }}" class="btn btn-outline-dark w-100 quick-action-btn d-flex flex-column align-items-center justify-content-center p-4">
    <i class="fas fa-briefcase-medical fa-3x mb-2"></i>
    <span class="fs-5">Ajouter profession</span>
</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Dernières actions -->
    <div class="row">
        <div class="col-12">
            <div class="recent-actions mt-4">
                <h4 class="section-title"><i class="fas fa-clock me-2"></i>Dernières actions</h4>
                <ul class="mb-0" style="opacity:0.7;">
                    <li>Ajout d'un étudiant</li>
                    <li>Suppression d'une promotion</li>
                    <li>Modification d'un diplôme</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection