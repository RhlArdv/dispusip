<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management
    Route::resource('users', UserController::class);

    // Role Management
    Route::resource('roles', RoleController::class);
    Route::get('roles/{role}/edit-permissions', [RoleController::class, 'edit'])
        ->name('roles.edit-permissions');
    Route::put('roles/{role}/permissions', [RoleController::class, 'update'])
        ->name('roles.update-permissions');
    Route::post('roles/{role}/reset', [RoleController::class, 'reset'])
        ->name('roles.reset');

    // Arsip Management
    Route::resource('arsip', ArsipController::class)
        ->middleware(['auth', 'permission:view_arsip']);

    // Berita Management
    Route::resource('berita', BeritaController::class)
        ->middleware(['auth', 'permission:view_berita']);

    // Koleksi Management
    Route::resource('koleksi', KoleksiController::class)
        ->middleware(['auth', 'permission:view_koleksi']);
});

require __DIR__.'/auth.php';
