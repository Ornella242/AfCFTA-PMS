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
}
