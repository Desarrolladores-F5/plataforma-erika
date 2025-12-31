<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Crear un módulo dentro de un curso
     */
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer|min:1',
        ]);

        // Si no viene orden, lo ponemos al final
        $data['order'] = $data['order']
            ?? ($course->modules()->max('order') ?? 0) + 1;

        $course->modules()->create($data);

        return back()->with('success', 'Módulo creado correctamente.');
    }

    /**
     * Actualizar un módulo
     */
    public function update(Request $request, Course $course, Module $module)
    {
        // Seguridad extra: el módulo debe pertenecer al curso
        if ($module->course_id !== $course->id) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer|min:1',
        ]);

        $module->update($data);

        return back()->with('success', 'Módulo actualizado.');
    }

    /**
     * Eliminar un módulo
     */
    public function destroy(Course $course, Module $module)
    {
        // Seguridad extra
        if ($module->course_id !== $course->id) {
            abort(403);
        }

        $module->delete();

        return back()->with('success', 'Módulo eliminado.');
    }
}

