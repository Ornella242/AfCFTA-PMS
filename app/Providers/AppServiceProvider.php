<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Project;

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
        // dd('boot is working');

    }
}
