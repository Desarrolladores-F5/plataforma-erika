<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\WebpayController; // 👈 FALTABA ESTA
use App\Http\Controllers\AdminController;   // 👈 NUEVO
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminStudentController;


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

// ⭐ Dashboard inteligente (admin / alumno)
Route::get('/dashboard', function () {

    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return app(\App\Http\Controllers\StudentDashboardController::class)->index();

})->middleware(['auth', 'verified'])
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

// ⭐ Historial de compras para que no se dupliquen los cursos al ir al Voucher
Route::get('/orders/{order}', [WebpayController::class, 'show'])
    ->middleware('auth')
    ->name('orders.show');

// ✅ PDF del voucher (PRO)
Route::get('/orders/{order}/pdf', [WebpayController::class, 'pdf'])
    ->middleware('auth')
    ->name('orders.pdf');

// ⭐ Panel admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        // Órdenes / Pagos
        Route::get('/ordenes', [AdminOrderController::class, 'index'])
            ->name('admin.orders.index');

        // Actualizar estado de orden
        Route::patch('/ordenes/{order}', [AdminOrderController::class, 'update'])
            ->name('admin.orders.update');

        // Alumnos
        Route::get('/alumnos', [AdminStudentController::class, 'index'])
            ->name('admin.students.index');

    });

// ⭐ Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ⭐ Breeze (auth)
require __DIR__.'/auth.php';
