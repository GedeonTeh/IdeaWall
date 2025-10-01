<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalIdeas = Idea::count();
        $totalUsers = User::count();
        $totalVotes = Vote::count();
        
        // Top 3 des idées avec le plus de votes
        $topIdeas = Idea::with(['user', 'votes'])
            ->withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->take(3)
            ->get();
        
        // Toutes les idées pour la gestion
        $allIdeas = Idea::with(['user'])
            ->withCount('votes')
            ->latest()
            ->get();
        
        // Tous les utilisateurs
        $users = User::withCount(['votes'])
            ->latest()
            ->get();
        
        // Stats pour les graphiques
        $ideasByMonth = Idea::select(
            DB::raw("strftime('%Y-%m', created_at) as month"),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month', 'desc')
        ->take(6)
        ->get()
        ->reverse()
        ->values();
        
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalIdeas' => $totalIdeas,
                'totalUsers' => $totalUsers,
                'totalVotes' => $totalVotes,
            ],
            'topIdeas' => $topIdeas,
            'allIdeas' => $allIdeas,
            'users' => $users,
            'ideasByMonth' => $ideasByMonth,
        ]);
    }
}