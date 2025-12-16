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
Route::get('/pagar/{slug}', [CourseController::class, 'iniciarCompra'])
    ->middleware('auth')
    ->name('checkout.iniciar');

// ⭐ Webpay: iniciar transacción real 👇
Route::post('/pagar/{slug}', [WebpayController::class, 'iniciar'])   // aca cambiamos de get a
    ->middleware('auth')
    ->name('webpay.iniciar');

// URL de retorno desde Webpay
Route::match(['GET', 'POST'], '/webpay/retorno', [WebpayController::class, 'retorno'])
    ->name('webpay.retorno');

// ⭐ Página pública del curso
Route::get('/curso/{slug}', [CourseController::class, 'show'])
    ->name('curso.detalle');

// ⭐ Dashboard de alumno
Route::get('/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ⭐ Historial de compras (vouchers)
Route::get('/mis-compras', function () {
    $orders = auth()->user()
        ->orders()
        ->with('course')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('orders.index', compact('orders'));
})->middleware('auth')->name('orders.index');

// ✅ PDF del voucher (PRO)
Route::get('/orders/{order}/pdf', [WebpayController::class, 'pdf'])
    ->middleware('auth')
    ->name('orders.pdf');

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
