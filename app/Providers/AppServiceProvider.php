<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Project;
use App\Models\Report;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //      View::composer('*', function ($view) {
    //     $view->with('totalUsers', User::count());
    // });
    // }

   public function boot(): void
    {
        View::share('totalUsers', \App\Models\User::count());
        View::share('totalProjects', \App\Models\Project::count());
        View::share('totalProjectsHRM', \App\Models\Project::where('type', 'HRM')->count());
        View::share('totalProjectsAdmin', \App\Models\Project::where('type', 'Admin')->count());
        View::share('totalReports', \App\Models\Report::count());
        View::share('totalTasks', \App\Models\Task::count());
       View::composer('*', function ($view) {
    if ($user = Auth::user()) {
        // Filtre commun : uniquement les tâches non archivées
        $notArchived = function ($query) {
            $query->where(function ($q) {
                $q->where('is_archived', false)
                  ->orWhereNull('is_archived');
            })->where(function ($q) {
                $q->where('archived', false)
                  ->orWhereNull('archived');
            });
        };

        // Nombre de tâches assignées à l'utilisateur
        $assignedToUser = Task::where('assigned_to', $user->id)
            ->where($notArchived)
            ->count();

        // Nombre de tâches créées par l'utilisateur
        $assignedByUser = Task::where('created_by', $user->id)
            ->where($notArchived)
            ->count();

        // Nombre total (assignées OU créées)
        $totalRelated = Task::where(function ($q) use ($user) {
                $q->where('assigned_to', $user->id)
                  ->orWhere('created_by', $user->id);
            })
            ->where($notArchived)
            ->count();

        // Partage les 3 variables globalement
        View::share([
            'assignedToUser' => $assignedToUser,
            'assignedByUser' => $assignedByUser,
            'totalTasks'     => $totalRelated,
        ]);
    }
});
        
        View::share('totalTasksHRM', \App\Models\Task::where('type', 'HRM')->count());
        View::share('totalTasksAdmin', \App\Models\Task::where('type', 'Admin')->count());
        // dd('boot is working');

    }
}
