<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentative de connexion étudiant par INE
        $etudiant = Etudiant::where('ine', $credentials['identifier'])->first();
        if ($etudiant && Hash::check($credentials['password'], $etudiant->password)) {
            Auth::guard('etudiant')->login($etudiant);
            return redirect()->route('etudiant.dashboard');
        }

        // Tentative de connexion admin par username
        $admin = \App\Models\Admin::where('username', $credentials['identifier'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'identifier' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('etudiant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
