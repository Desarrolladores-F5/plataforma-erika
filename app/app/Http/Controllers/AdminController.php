<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // 🔢 Métricas existentes
        $totalVentas  = Order::where('status', 'pagado')->sum('amount');
        $totalOrdenes = Order::where('status', 'pagado')->count();
        $totalAlumnos = User::where('role', 'student')->count();
        $totalCursos  = Course::count();

        // 📊 Ventas por día (últimos 7 días)
        $ventasPorDia = Order::select(
                DB::raw('DATE(created_at) as fecha'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'pagado')
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->take(7)
            ->get();        
        
        // 🧾 Últimas órdenes
        $ultimasOrdenes = Order::with(['user', 'course'])
            ->latest()
            ->take(10)
            ->get();
        
        // 📈 Ventas por curso (Top)
        $ventasPorCurso = Order::where('status', 'pagado')
            ->selectRaw('course_id, COUNT(*) as compras, SUM(amount) as total')
            ->groupBy('course_id')
            ->with('course')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        // 📊 Ventas por mes
        $ventasPorMes = Order::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'pagado')
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->take(12)
            ->get();

        
        $alumnosActivos = User::where('role', 'student')
            ->whereHas('orders', function ($q) {
                $q->where('status', 'pagado');
            })
            ->count();

        return view('admin.dashboard', compact(
            'totalVentas',
            'totalOrdenes',
            'totalAlumnos',
            'totalCursos',
            'ventasPorDia',
            'ultimasOrdenes',
            'ventasPorCurso',
            'alumnosActivos',       
            'ventasPorMes'     // Agregado
        ));
    }
}
