<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

// ⭐ PERFECTO: La Home apunta al welcome.blade.php
Route::get('/', function () {
    return view('welcome');
});

// ⭐ Ruta inteligente para "Tu Espacio (login)"
Route::get('/mi-espacio', function () {

    // Si no está logueado → ir al login
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Si el usuario es admin → ir al panel admin
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Usuarios normales → dashboard estándar
    return redirect()->route('dashboard');

})->name('mi.espacio');

// ⭐ La ruta que apunta a curso_detalle
Route::get('/curso/detalle', function () {
    return view('curso_detalle');
})->name('curso.detalle');

// ⭐ dashboard protegido por login + verificación
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ⭐ Panel de administración (solo Erika)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// ⭐ Rutas de perfil, protegidas
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ⭐ Incluye las rutas de Breeze (login, register, logout, etc.)
require __DIR__.'/auth.php';
