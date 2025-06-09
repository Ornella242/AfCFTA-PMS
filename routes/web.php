<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});
Route::view('/login', 'auth.login');
Route::view('/dashboard', 'dashboard');
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
Route::view('/users', 'users');
Route::view('/roles', 'roles');