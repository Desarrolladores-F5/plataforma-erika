<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonProgressController extends Controller
{
    public function store(Request $request, Course $course, Lesson $lesson)
    {
        // 🔐 1. Validar que la lección pertenece al curso
        if (!$lesson->module || $lesson->module->course_id !== $course->id) {
            abort(404);
        }

        $user = $request->user();

        // 🎟️ 2. Validar acceso del usuario al curso (si no es lección preview)
        $userHasAccess = $user->orders()
            ->where('course_id', $course->id)
            ->where('status', 'pagado')
            ->exists();

        if (!$lesson->is_preview && !$userHasAccess) {
            abort(403);
        }

        // ✅ 3. Marcar lección como completada sin duplicar registros
        $user->lessons()->syncWithoutDetaching([
            $lesson->id => ['completed_at' => now()]
        ]);

        return redirect()
            ->route('curso.ver', $course->id)
            ->with('success', 'Lección marcada como completada ✅');
    }
}
