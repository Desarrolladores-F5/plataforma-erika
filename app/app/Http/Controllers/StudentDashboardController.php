<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $courses = $user->courses()
            ->with('modules.lessons') // 🔥 Carga módulos y lecciones para calcular progreso real
            ->get();

        return view('student.dashboard', compact('courses'));
    }
}
