<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    /**
     * Página principal (landing) - welcome.blade.php
     */
    public function home()
    {
        $courses = Course::where('is_published', true)
            ->where('is_demo', false)   // 👈 NO mostrar cursos de prueba
            ->latest()
            ->take(6)           // 👈 SOLO 1 curso, si quiero que muestre 2, pongo 2
            ->get();

        return view('welcome', compact('courses'));
    }

    /**
     * Muestra el detalle de un curso a partir de su slug.
     */
    public function show(string $slug)
    {
        // Buscamos el curso por slug y cargamos módulos + lecciones
        $course = Course::where('slug', $slug)
            ->where('is_published', true) // si estás usando publicados
            ->with(['modules.lessons'])
            ->firstOrFail();

        $userHasAccess = false;

        if (auth()->check()) {
            $userHasAccess = auth()->user()
                ->orders()
                ->where('course_id', $course->id)
                ->where('status', 'pagado') // OJO: debe coincidir con tu BD
                ->exists();
        }

        // 🧠 3️⃣ AQUÍ VA EL BLOQUE NUEVO (curso completado)
        $courseCompleted = false;

        if (auth()->check()) {
            $totalLessons = $course->modules
                ->flatMap->lessons
                ->count();

            $completedLessons = auth()->user()
                ->completedLessons()
                ->whereIn(
                    'lessons.id',
                    $course->modules->flatMap->lessons->pluck('id')
                )
                ->count();

            if ($totalLessons > 0 && $completedLessons === $totalLessons) {
                $courseCompleted = true;
            }
        }

        // Vista del alumno, dentro de /views/student
        return view('courses.show', compact(
            'course',
            'userHasAccess',
            'courseCompleted'
        ));
    }

    public function ver(string $slug)
    {
        $course = Course::where('slug', $slug)
            ->where('is_published', true)
            ->with(['modules.lessons'])
            ->firstOrFail();

        // Debe estar logueado (igual lo protegemos por ruta)
        $user = auth()->user();

        // Acceso al curso (pago)
        $userHasAccess = $user->orders()
            ->where('course_id', $course->id)
            ->where('status', 'pagado')
            ->exists();

        // IDs de lecciones del curso
        $lessonIds = $course->modules->flatMap->lessons->pluck('id');

        $totalLessons = $lessonIds->count();

        // Lecciones completadas por el usuario (pivot completed_at)
        $completedLessons = $user->completedLessons()
            ->whereIn('lessons.id', $lessonIds)
            ->count();

        // Progreso
        $progress = $totalLessons > 0
            ? round(($completedLessons / $totalLessons) * 100)
            : 0;

        // Curso completado
        $courseCompleted = $totalLessons > 0 && $completedLessons >= $totalLessons;

        // (Opcional) si tu JS necesita una lección inicial
        $currentLesson = $course->modules->flatMap->lessons->first();

        return view('student.curso_detalle', compact(
            'course',
            'userHasAccess',
            'progress',
            'courseCompleted',
            'currentLesson'
        ));
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
        // 1️⃣ Validación
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:courses,slug',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'promo_video_url' => 'nullable|url',                 // Nuevo
            'thumbnail' => 'nullable|image|max:2048',            // Nuevo
            'banner_url' => 'nullable|image|max:4096',           // Nuevo
            'is_published'   => 'nullable|boolean',

        ]);

        // 2️⃣ Guardar archivos (SI existen)
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('courses/thumbnails', 'public');
        }

        if ($request->hasFile('banner_url')) {
            $data['banner_url'] = $request->file('banner_url')
                ->store('courses/banners', 'public');
        }

        // 3️⃣ Checkbox publicado
        $data['is_published'] = $request->boolean('is_published');

        // 4️⃣ Crear curso
        Course::create($data);

        // 5️⃣ Redirigir
        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso creado correctamente ✅');


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

    public function destroy(Course $course)
    {
        // (opcional) borrar imágenes asociadas
        if ($course->thumbnail) {
            \Storage::disk('public')->delete($course->thumbnail);
        }

        if ($course->banner_url) {
            \Storage::disk('public')->delete($course->banner_url);
        }

        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Curso eliminado correctamente 🗑️');
    }

}
