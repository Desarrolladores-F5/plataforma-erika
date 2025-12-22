<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Course;

class AdminController extends Controller
{
    public function index()
    {
        $totalVentas  = Order::where('status', 'pagado')->sum('amount');
        $totalOrdenes = Order::where('status', 'pagado')->count();
        $totalAlumnos = User::where('role', 'user')->count();
        $totalCursos  = Course::count();

        $ultimasOrdenes = Order::with(['user', 'course'])
            ->latest()
            ->take(10)
            ->get();

        $ventasPorCurso = Order::where('status', 'pagado')
            ->selectRaw('course_id, COUNT(*) as compras, SUM(amount) as total')
            ->groupBy('course_id')
            ->with('course')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalVentas',
            'totalOrdenes',
            'totalAlumnos',
            'totalCursos',
            'ultimasOrdenes',
            'ventasPorCurso'
        ));
    }
}
