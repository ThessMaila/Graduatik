<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gère une tentative de connexion.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->input('identifier');
        $password = $request->input('password');
        $remember = $request->filled('remember');

        Log::info('Tentative de connexion pour: ' . $identifier);

        // Tenter de connecter l'administrateur
        if (strtolower($identifier) === 'admin') {
            Log::info('Tentative de connexion admin pour: admin');
            if (Auth::guard('admin')->attempt(['username' => 'admin', 'password' => $password], $remember)) {
                $request->session()->regenerate();
                Log::info('Connexion admin réussie pour: admin');
                return redirect()->intended(route('admin.dashboard'));
            }
            Log::warning('Échec de connexion admin pour: admin');
        } else {
            // Tenter de connecter l'étudiant par INE
            Log::info('Tentative de connexion étudiant pour INE: ' . $identifier);
            if (Auth::guard('etudiant')->attempt(['ine' => $identifier, 'password' => $password], $remember)) {
                $request->session()->regenerate();
                Log::info('Connexion étudiant réussie pour INE: ' . $identifier);
                return redirect()->intended(route('etudiant.dashboard'));
            }
            Log::warning('Échec de connexion étudiant pour INE: ' . $identifier);
        }

        return back()->withErrors([
            'identifier' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ])->onlyInput('identifier');
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('etudiant')->check()) {
            Auth::guard('etudiant')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
