<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', User::ROLE_STUDENT);

        // 🔍 Buscar por nombre o email
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }

        // 🧍 Filtrar por género
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 🏙️ Filtrar por comuna
        if ($request->filled('comuna')) {
            $query->where('comuna', 'like', '%' . $request->comuna . '%');
        }

        // ✅ FILTRO POR NACIMIENTO (AQUÍ VA)
        // birth_from = fecha mínima (>=)
        if ($request->filled('birth_from')) {
            $query->whereDate('birth_date', '>=', $request->birth_from);
        }

        // birth_to = fecha máxima (<=)
        if ($request->filled('birth_to')) {
            $query->whereDate('birth_date', '<=', $request->birth_to);
        }

        $students = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // 🔥 mantiene filtros al paginar

        return view('admin.students.index', compact('students'));
    }
}

