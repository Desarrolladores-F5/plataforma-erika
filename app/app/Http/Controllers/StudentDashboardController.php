<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courses = $user->courses;   // cursos comprados

        return view('student.dashboard', compact('courses'));
    }
}
