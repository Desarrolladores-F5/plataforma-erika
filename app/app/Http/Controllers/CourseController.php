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

        // (Opcional) Si quieres, aquí podríamos validar que el usuario tenga acceso
        // $user = auth()->user();
        // if (! $user || ! $user->courses->contains($course->id)) {
        //     abort(403, 'No tienes acceso a este curso.');
        // }

        // Pasamos el curso a la vista que ya teníamos
        return view('curso_detalle', compact('course'));
    }
}
