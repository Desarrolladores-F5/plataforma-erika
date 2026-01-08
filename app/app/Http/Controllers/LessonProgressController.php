<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonProgressController extends Controller
{
    public function store(Request $request, Course $course, Lesson $lesson)
    {
        // seguridad: lección pertenece al curso
        if ($lesson->module->course_id !== $course->id) abort(404);

        $user = $request->user();

        // Solo si tiene acceso (o si es preview, opcional)
        $userHasAccess = $user->orders()
            ->where('course_id', $course->id)
            ->where('status', 'pagado')
            ->exists();

        if (!$lesson->is_preview && !$userHasAccess) abort(403);

        $user->completedLessons()->syncWithoutDetaching([
            $lesson->id => ['completed_at' => now()]
        ]);

        return back()->with('success', 'Lección marcada como completada ✅');
    }
}
