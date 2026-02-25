<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Accueil') - Graduatik | Gestion des Diplômés IBAM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <!-- Barre de navigation globale -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">
                <img src="{{ asset('images/logo_ibam.png') }}" alt="Logo IBAM" style="height:32px; width:32px; margin-right:8px;"> Graduatik
            </a>
            <div class="d-flex align-items-center ms-auto">
                @auth
                <form method="POST" action="{{ route('logout') }}" class="mb-0 ms-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Se déconnecter
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </nav>
    <div style="height:58px;"></div> <!-- Décalage pour la navbar fixed -->


    <!-- Mobile menu toggle -->
    <div class="d-md-none position-fixed top-0 end-0 p-3 z-index-high" style="z-index: 1040;">
        <button id="sidebarToggle" class="btn btn-primary rounded-circle shadow-lg">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <!-- Overlay for mobile sidebar -->
    <div class="overlay"></div>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (admin uniquement) -->
            @if(Auth::guard('admin')->check())
            <div class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="pt-4 h-100">
                    <div class="text-center mb-4 animate-fade-in">
    <!--<div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
        <img src="{{ asset('images/logo_ibam.png') }}" alt="Logo IBAM" style="height:36px; width:36px;">
        <span class="fw-bold" style="font-size: 1.8rem; color: #fff; letter-spacing: 1px;">Graduatik</span>
    </div>-->
    <p class="text-light opacity-75 mt-2">Gestion des Diplômés IBAM</p>
</div>
                    <ul class="nav flex-column">
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.1s">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.4s">
                            <a class="nav-link {{ request()->is('niveaux*') ? 'active' : '' }}" href="{{ route('niveaux.index') }}">
                                <i class="fas fa-layer-group me-2"></i>
                                Niveaux
                            </a>
                        </li>
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.5s">
                            <a class="nav-link {{ request()->is('filieres*') ? 'active' : '' }}" href="{{ route('filieres.index') }}">
                                <i class="fas fa-book me-2"></i>
                                Filières
                            </a>
                        </li>
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.6s">
                            <a class="nav-link {{ request()->is('promotions*') ? 'active' : '' }}" href="{{ route('promotions.index') }}">
                                <i class="fas fa-users me-2"></i>
                                Promotions
                            </a>
                        </li>
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.2s">
                            <a class="nav-link {{ request()->is('etudiants*') ? 'active' : '' }}" href="{{ route('etudiants.index') }}">
                                <i class="fas fa-user-graduate me-2"></i>
                                Étudiants
                            </a>
                        </li>
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.3s">
                            <a class="nav-link {{ request()->is('diplomes*') ? 'active' : '' }}" href="{{ route('diplomes.index') }}">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Diplômes
                            </a>
                        </li>
                        <li class="nav-item animate-slide-up" style="animation-delay: 0.7s">
                            <a class="nav-link {{ request()->is('professions*') ? 'active' : '' }}" href="{{ route('professions.index') }}">
                                <i class="fas fa-briefcase me-2"></i>
                                Professions
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            <!-- Main content -->
            @if(Auth::guard('admin')->check())
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            @else
            <div class="col-12 p-0 main-content">
            @endif
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom animate-fade-in">
                    <h1 class="h2 fw-bold">@yield('title')</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success shadow-sm rounded-lg animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger shadow-sm rounded-lg animate__animated animate__fadeIn">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="fade-in">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Mobile sidebar toggle
        $(document).ready(function() {
            // Toggle sidebar on mobile
            $('#sidebarToggle').on('click', function(e) {
                e.preventDefault();
                $('.sidebar').toggleClass('active');
                $('.overlay').toggleClass('active');
                $('body').toggleClass('sidebar-open');
            });
            
            // Close sidebar when clicking on overlay
            $('.overlay').on('click', function() {
                $('.sidebar').removeClass('active');
                $('.overlay').removeClass('active');
                $('body').removeClass('sidebar-open');
            });
            
            // Close sidebar when clicking on a link (mobile only)
            $('.sidebar .nav-link').on('click', function() {
                if ($(window).width() < 768) {
                    $('.sidebar').removeClass('active');
                    $('.overlay').removeClass('active');
                    $('body').removeClass('sidebar-open');
                }
            });
            
            // Animation for cards when they come into view
            const animateOnScroll = function() {
                $('.card').each(function() {
                    const cardPosition = $(this).offset().top;
                    const scrollPosition = $(window).scrollTop() + $(window).height() * 0.9;
                    
                    if (scrollPosition > cardPosition) {
                        $(this).addClass('animate-fade-in');
                    }
                });
            };
            
            // Run on page load
            animateOnScroll();
            
            // Run on scroll
            $(window).scroll(function() {
                animateOnScroll();
            });
        });
    </script>
    
    @yield('scripts')
    <footer class="bg-white border-top py-3 mt-5">
        <div class="container text-center text-muted">
            © 2025 Graduatik — Plateforme de gestion des sortants de l'Institut Burkinabè des Arts et Métiers
        </div>
    </footer>
</body>
</html>
