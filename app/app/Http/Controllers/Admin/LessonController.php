<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Crear una lección dentro de un módulo
     */
    public function store(Request $request, Course $course, Module $module)
    {
        // Seguridad: el módulo debe pertenecer al curso
        if ($module->course_id !== $course->id) {
            abort(403);
        }

        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'video_url'  => 'nullable|url',
            'pdf_file'   => 'nullable|file|mimes:pdf|max:20480',
            'order'      => 'nullable|integer|min:1',
            'is_preview' => 'nullable|boolean',
        ]);

        // Subida de PDF
        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')
                ->store('lessons/pdfs', 'public');
        }

        // Orden automático
        $data['order'] = $data['order']
            ?? ($module->lessons()->max('order') ?? 0) + 1;

        $data['is_preview'] = $request->boolean('is_preview');

        $module->lessons()->create($data);

        return back()->with('success', 'Lección creada correctamente.');
    }

    /**
     * Actualizar una lección
     */
    public function update(Request $request, Course $course, Module $module, Lesson $lesson)
    {
        if (
            $module->course_id !== $course->id ||
            $lesson->module_id !== $module->id
        ) {
            abort(403);
        }

        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'video_url'  => 'nullable|url',
            'pdf_file'   => 'nullable|file|mimes:pdf|max:20480',
            'order'      => 'nullable|integer|min:1',
            'is_preview' => 'nullable|boolean',
        ]);

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')
                ->store('lessons/pdfs', 'public');
        }

        $data['is_preview'] = $request->boolean('is_preview');

        $lesson->update($data);

        return back()->with('success', 'Lección actualizada.');
    }

    /**
     * Eliminar una lección
     */
    public function destroy(Course $course, Module $module, Lesson $lesson)
    {
        if (
            $module->course_id !== $course->id ||
            $lesson->module_id !== $module->id
        ) {
            abort(403);
        }

        $lesson->delete();

        return back()->with('success', 'Lección eliminada.');
    }
}

