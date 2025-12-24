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
        return view('webpay.iniciar', compact('course'));
    }

    // -------------------------
    // ADMIN: CRUD de Cursos
    // -------------------------

    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:courses,slug',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'is_published'   => 'nullable|boolean',
        ]);

        // Si no viene checkbox, que sea 0
        $data['is_published'] = $request->boolean('is_published');

        Course::create($data);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso creado correctamente ✅');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'is_published'   => 'nullable|boolean',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $course->update($data);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso actualizado correctamente ✅');
    }

}
