<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// protégé par auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::get('/', function () {
    return view('auth.register');
});
Route::view('/login', 'auth.login');
Route::view('/dashboard', 'dashboard');
Route::view('/addnewproject', 'newproject');
Route::view('/allprojects', 'allprojects');
Route::view('/adminprojects', 'adminprojects');
Route::view('/hrmprojects', 'hrmprojects');
Route::view('/projectdetail', 'projectdetail');

Route::view('/alltasks', 'alltasks');
Route::view('/edittask', 'edittask');
Route::view('/hrmtasks', 'hrmtasks');
Route::view('/admintasks', 'admintasks');
Route::view('/reports', 'reports');
Route::view('/viewreport', 'viewreport');

Route::view('/logs', 'logs');
// Route::view('/users', 'users');
// Route::view('/createuser', 'createuser');
Route::view('/roles', 'roles');

Route::get('/users/create', [UserController::class, 'create'])->name('createuser');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users'); // pour la liste
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::get('/roles', [RoleController::class, 'roleOverview'])->name('roles.overview');
Route::get('/roles/{id}/users', [RoleController::class, 'getRoleUsers']);
Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
Route::post('/assign-role', [UserController::class, 'assignRole'])->name('assign.role');



// Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');



