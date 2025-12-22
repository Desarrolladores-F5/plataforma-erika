<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }
}

