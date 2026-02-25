<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantProfessionController;
use App\Http\Controllers\AdminDashboardController; // Ajout du contrôleur AdminDashboardController


// Routes d'authentification personnalisées
// Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // Commenté car remplacé
// Route::post('login', [AuthController::class, 'login'])->name('login.submit'); // Commenté car remplacé
// Route::post('logout', [AuthController::class, 'logout'])->name('logout'); // Commenté car remplacé

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login'); // Affiche le formulaire
    Route::post('login', 'login')->name('login.submit'); // Traite la soumission du formulaire
    Route::post('logout', 'logout')->name('logout'); // Déconnexion
});

// Placeholder pour les tableaux de bord (vous créerez ces vues/contrôleurs plus tard)
// Routes pour les administrateurs
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Ajoutez d'autres routes admin ici
    Route::post('/notifications/{id}/mark-as-read', [AdminDashboardController::class, 'markNotificationAsRead'])->name('notifications.markAsRead'); // Nouvelle route pour marquer une notification comme lue
    Route::post('/notifications/mark-all-as-read', [AdminDashboardController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/professions/liste', [App\Http\Controllers\AdminProfessionController::class, 'liste'])->name('professions.liste');
});

// Routes pour les étudiants
Route::middleware(['auth:etudiant'])->prefix('etudiant')->name('etudiant.')->group(function () {
    Route::get('/dashboard', function () {
        return view('etudiant.dashboard'); 
    })->name('dashboard');
    Route::post('/professions', [EtudiantProfessionController::class, 'store'])->name('professions.store');
    Route::put('/professions/{profession}', [EtudiantProfessionController::class, 'update'])->name('professions.update');
    // Ajoutez d'autres routes étudiant ici
});

// Route d'accueil - Tableau de bord
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    if (Auth::guard('etudiant')->check()) {
        return redirect()->route('etudiant.dashboard');
    }
    return redirect()->route('login');
    return view('welcome');
})->name('home');

// Routes d'authentification (Anciennes, commentées pour utiliser le nouveau LoginController)
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour les étudiants
Route::resource('etudiants', EtudiantController::class);
Route::get('/etudiants/{etudiant}/password', [EtudiantController::class, 'editPassword'])->name('etudiants.password.edit');
Route::put('/etudiants/{etudiant}/password', [EtudiantController::class, 'updatePassword'])->name('etudiants.password.update');

// Routes pour les diplômes
Route::resource('diplomes', DiplomeController::class);

// Routes pour les niveaux
Route::resource('niveaux', NiveauController::class);

// Routes pour les filières
Route::resource('filieres', FiliereController::class);

// Routes pour les promotions
Route::resource('promotions', PromotionController::class);

// Routes pour les professions
Route::resource('professions', ProfessionController::class);

// Routes pour l'interface étudiant (protégées par auth:etudiant)
Route::middleware(['auth:etudiant'])->group(function () {
    Route::get('/etudiant/dashboard', [EtudiantProfessionController::class, 'dashboard'])->name('etudiant.dashboard');
    Route::get('/etudiant/professions/create', [EtudiantProfessionController::class, 'create'])->name('etudiant.professions.create');
    Route::post('/etudiant/professions', [EtudiantProfessionController::class, 'store'])->name('etudiant.professions.store');
    Route::get('/etudiant/professions/{profession}/edit', [EtudiantProfessionController::class, 'edit'])->name('etudiant.professions.edit');
    Route::put('/etudiant/professions/{profession}', [EtudiantProfessionController::class, 'update'])->name('etudiant.professions.update');
});

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirection depuis la racine
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    if (Auth::guard('etudiant')->check()) {
        return redirect()->route('etudiant.dashboard');
    }
    return redirect()->route('login');
})->name('dashboard');

// Route pour que l'admin voie le parcours professionnel d'un étudiant
Route::middleware(['auth:admin'])->get('/admin/etudiants/{etudiant}/parcours', [App\Http\Controllers\EtudiantController::class, 'parcoursProfessionnel'])->name('admin.etudiants.parcours');
