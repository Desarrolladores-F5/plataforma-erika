<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\WebpayController; // 👈 FALTABA ESTA

// ⭐ Home pública
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ⭐ Espacio inteligente
Route::get('/mi-espacio', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');

})->name('mi.espacio');

// ⭐ Iniciar compra
Route::get('/comprar/{slug}', [CourseController::class, 'iniciarCompra'])
    ->name('checkout.iniciar');

// ⭐ Webpay: iniciar transacción real 👇
Route::get('/pagar/{slug}', [WebpayController::class, 'iniciar'])
    ->middleware('auth')
    ->name('webpay.iniciar');


// ⭐ Página pública del curso
Route::get('/curso/{slug}', [CourseController::class, 'show'])
    ->name('curso.detalle');

// ⭐ Dashboard de alumno
Route::get('/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ⭐ Panel admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// ⭐ Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ⭐ Breeze (auth)
require __DIR__.'/auth.php';
