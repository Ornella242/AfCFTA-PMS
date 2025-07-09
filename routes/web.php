<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use  App\Http\Controllers\DevelopmentDetailController;
use App\Http\Controllers\ProjectDeletionRequestController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// protégé par auth
Route::middleware('auth')->group(function () {
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



Route::get('/', function () {
    return view('auth.register');
});
Route::view('/login', 'auth.login');
// Route::view('/newproject', 'newproject');
// Route::view('/allprojects', 'allprojects');
// Route::view('/adminprojects', 'adminprojects');
// Route::view('/hrmprojects', 'hrmprojects');
// Route::view('/projectdetail', 'projectdetail');

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


Route::post('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.update');
Route::get('/change-password', [AuthController::class, 'changePassword'])->name('password.change');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

Route::get('/allprojects', [ProjectController::class, 'index'])->name('allprojects');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::patch('/projects/{project}/update-field', [ProjectController::class, 'updateField'])->name('projects.updateField');

Route::get('/projects/{project}/edit/{field}', [ProjectController::class, 'editField'])->name('projects.editField');
Route::put('/projects/{project}/update/{field}', [ProjectController::class, 'updateField'])->name('projects.updateField');

Route::post('/projects/{id}/update-field', [ProjectController::class, 'updateField'])->name('projects.updateField');
Route::patch('/projects/{project}/subphases/{subphase}/status', [ProjectController::class, 'updateSubphaseStatus'])->name('projects.updateSubphaseStatus');
Route::post('/projects/{id}/add-procurement', [ProjectController::class, 'addProcurementPhase'])
    ->name('projects.addProcurementPhase');
Route::patch('/development-activity/{id}/update-status', [DevelopmentDetailController::class, 'updateStatus'])->name('developmentDetails.updateStatus');
Route::patch('/development-details/{id}/update-status', [DevelopmentDetailController::class, 'updateStatus'])->name('developmentDetails.updateStatus');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('/hrmprojects', [ProjectController::class, 'hrmProjects'])->name('projects.hrm');
Route::get('/adminprojects', [ProjectController::class, 'adminProjects'])->name('projects.admin');

Route::post('/development-details', [DevelopmentDetailController::class, 'store'])->name('developmentDetails.store');
// Route::put('/development-details/{id}', [DevelopmentDetailController::class, 'update'])->name('developmentDetails.update');
// Route::delete('/development-details/{id}', [DevelopmentDetailController::class, 'destroy'])->name('developmentDetails.destroy');

Route::post('/projects/{id}/request-delete', [ProjectController::class, 'requestDelete'])->name('projects.requestDelete');
Route::post('/projects/{id}/approve-deletion', [ProjectController::class, 'approveDeletion'])->middleware('admin')->name('projects.approveDeletion');
// Route::middleware(['auth', 'is_admin'])->group(function () {
//     Route::get('/admin/deletion-requests', [ProjectDeletionRequestController::class, 'index'])->name('deletionRequests.index');
//     Route::patch('/admin/deletion-requests/{id}/approve', [ProjectDeletionRequestController::class, 'approve'])->name('deletionRequests.approve');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/deletion-requests', [ProjectDeletionRequestController::class, 'index'])->name('deletionRequests.index');
// });
// Route::post('/admin/deletion-requests/{id}/approve', [ProjectDeletionRequestController::class, 'approve'])
//     ->name('deletionRequests.approve');

Route::post('/deletion-requests/{id}/approve', [ProjectDeletionRequestController::class, 'approve'])
    ->name('deletionRequests.approve');

Route::delete('/deletion-requests/{id}/decline', [ProjectDeletionRequestController::class, 'decline'])
    ->name('deletionRequests.decline');

Route::patch('/projects/{project}/reactivate', [ProjectController::class, 'reactivate'])->name('projects.reactivate');
