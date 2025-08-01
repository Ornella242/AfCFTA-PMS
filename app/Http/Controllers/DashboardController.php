<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'Not started' => Project::where('status', 'Not started')->count(),
            'In progress' => Project::where('status', 'In progress')->count(),
            'Completed' => Project::where('status', 'Completed')->count(),
            'Cancelled' => Project::where('status', 'Cancelled')->count(),
        ];
        $projectManagers = User::whereHas('managedProjects')
        ->withCount('managedProjects')
        ->with(['managedProjects' => function($query) {
            $query->select('id', 'title', 'percentage', 'project_manager_id');
        }])
        ->get();
        $latestProjects = Project::with(['partners', 'unit'])
        ->latest()
        ->take(5)
        ->get();

        return view('dashboard', compact('counts','projectManagers','latestProjects'));
    }

    public function pma()
    {
        
        $user = \Illuminate\Support\Facades\Auth::user();
        $projectsAsMember = $user->memberProjects ?? 'none';
        $asMember = $user->memberProjects()->with('phases')->get(); // relation many-to-many
        $asAssistant = $user->assistingProjects()->with('phases')->get(); // relation many-to-many

        $relatedProjects = $asMember->merge($asAssistant);
       
        // Si l'utilisateur est Assistant ou Member
        if (in_array($user->role->name ?? '', ['Project Manager Assistant', 'Member'])) {
           
            $relatedProjects = Project::whereHas('assistants', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orWhereHas('members', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with(['unit', 'partners', 'phases']) // charge les phases
                ->latest()
                ->get();


            // Statuts des projets liés uniquement
            $counts = [
                'Not started' => $relatedProjects->where('status', 'Not started')->count(),
                'In progress' => $relatedProjects->where('status', 'In progress')->count(),
                'Completed' => $relatedProjects->where('status', 'Completed')->count(),
                'Cancelled' => $relatedProjects->where('status', 'Cancelled')->count(),
            ];

            $latestProjects = $relatedProjects->take(5);
        } else {
            //  dd('hi');
            // Si ce n’est pas un assistant ou member, ne rien montrer
            $relatedProjects = collect();
            $counts = [
                'Not started' => 0,
                'In progress' => 0,
                'Completed' => 0,
                'Cancelled' => 0,
            ];
            $latestProjects = collect();
        }

        // Optionnel : seulement si tu veux afficher tous les Project Managers
        $projectManagers = User::whereHas('managedProjects')
            ->withCount('managedProjects')
            ->with(['managedProjects' => function($query) {
                $query->select('id', 'title', 'percentage', 'project_manager_id');
            }])
            ->get();

        return view('dashboardpma', compact('counts', 'projectManagers', 'latestProjects', 'relatedProjects'));
    }

}
