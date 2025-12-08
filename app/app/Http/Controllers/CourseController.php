<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Muestra el detalle de un curso a partir de su slug.
     */
    public function show(string $slug)
    {
        // Buscamos el curso por slug y cargamos módulos + lecciones
        $course = Course::where('slug', $slug)
            ->with(['modules.lessons'])
            ->firstOrFail();

        // Vista del alumno, dentro de /views/student
        return view('student.curso_detalle', compact('course'));
    }

    public function iniciarCompra($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        // Si NO está logueado → enviarlo al registro
        if (!auth()->check()) {
            // Opcional: guardar a dónde volver después
            session(['redirect_after_register' => route('checkout.iniciar', $slug)]);

            return redirect()->route('register');
        }

        // 🔥 TEMPORALMENTE DESACTIVADO
        // Más adelante, cuando tengamos pagos reales, lo activamos de nuevo
        /*
        if ($course->users()->where('user_id', auth()->id())->exists()) {
            // Ya lo tiene comprado → al curso
            return redirect()->route('curso.detalle', $slug);
        }
        */

        // Usuario logueado y sin compra registrada → mostrar checkout
        return view('checkout.index', compact('course'));
    }

}
