<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonViewController extends Controller
{
    public function show(Course $course, Lesson $lesson)
    {
        // Seguridad: la lección debe pertenecer al curso
        if ($lesson->module->course_id !== $course->id) {
            abort(404);
        }

        // Detectar acceso
        $userHasAccess = false;

        if (auth()->check()) {
            $userHasAccess = auth()->user()
                ->orders()
                ->where('course_id', $course->id)
                ->where('status', 'pagado')
                ->exists();
        }

        // Si NO es preview y NO tiene acceso → bloqueado
        if (!$lesson->is_preview && !$userHasAccess) {
            abort(403);
        }

        $module = $lesson->module;

        return view('student.lesson_show', compact(
            'course',
            'module',
            'lesson',
            'userHasAccess'
        ));
    }
}
