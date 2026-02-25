<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Etudiant;
use App\Models\Diplome;
use App\Models\Promotion;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $etudiantsCount = Etudiant::count();
        $diplomesCount = Diplome::count();
        $promotionsCount = Promotion::count();
        $notifications = Notification::with('etudiant')
            ->where('type', 'parcours_pro')
            ->whereNull('read_at')
            ->latest()
            ->get();
        // Charger la dernière profession pour chaque notification
        foreach ($notifications as $notif) {
            $notif->profession = null;
            if ($notif->etudiant) {
                $notif->profession = $notif->etudiant->professions()->latest()->first();
            }
        }
        return view('admin.dashboard', compact('etudiantsCount', 'diplomesCount', 'promotionsCount', 'notifications'));
    }

    public function markNotificationAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->read_at = now();
            $notification->save();
        }
        return redirect()->route('admin.dashboard');
    }

    public function markAllAsRead()
    {
        Notification::where('type', 'parcours_pro')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        return redirect()->route('admin.dashboard');
    }
}
