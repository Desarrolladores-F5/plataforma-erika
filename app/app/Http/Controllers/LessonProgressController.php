<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonProgressController extends Controller
{
    public function store(Request $request, Course $course, Lesson $lesson)
    {
        // ==========================================================
        // 1. VALIDAR QUE LA LECCIÓN PERTENECE AL CURSO
        // ==========================================================

        if (!$lesson->module || $lesson->module->course_id !== $course->id) {
            abort(404);
        }

        $user = $request->user();

        // ==========================================================
        // 2. VALIDAR ACCESO DEL USUARIO AL CURSO
        // ==========================================================

        $userHasAccess = $user->orders()
            ->where('course_id', $course->id)
            ->where('status', 'pagado')
            ->exists();

        if (!$lesson->is_preview && !$userHasAccess) {
            abort(403);
        }

        // ==========================================================
        // 3. OBTENER TODAS LAS LECCIONES EN ORDEN PEDAGÓGICO
        // ==========================================================

        $course->load([
            'modules.lessons' => function ($query) {
                $query->orderBy('order');
            }
        ]);

        $allLessons = $course->modules
            ->flatMap(function ($module) {
                return $module->lessons;
            })
            ->values();

        $lessonIds = $allLessons->pluck('id');

        // ==========================================================
        // 4. OBTENER LAS LECCIONES COMPLETADAS POR EL USUARIO
        // ==========================================================

        $completedLessonIds = $user->lessons()
            ->whereIn('lessons.id', $lessonIds)
            ->whereNotNull('lesson_user.completed_at')
            ->pluck('lessons.id');

        // ==========================================================
        // 5. DETERMINAR LA SIGUIENTE LECCIÓN PERMITIDA
        // ==========================================================

        $nextLesson = $allLessons->first(function ($courseLesson) use ($completedLessonIds) {
            return !$completedLessonIds->contains($courseLesson->id);
        });

        $nextLessonId = $nextLesson?->id;

        // ==========================================================
        // 6. PROTEGER EL AVANCE SECUENCIAL
        // ==========================================================

        $lessonAlreadyCompleted = $completedLessonIds->contains($lesson->id);

        // Permitimos completar solamente:
        // - una lección que ya estaba completada, o
        // - la siguiente lección que corresponde realizar.
        if (!$lessonAlreadyCompleted && $lesson->id !== $nextLessonId) {
            return redirect()
                ->route('curso.ver', $course->slug)
                ->with('error', 'Debes completar la lección anterior antes de continuar.');
        }

        // ==========================================================
        // 7. MARCAR LA LECCIÓN COMO COMPLETADA
        // ==========================================================

        $user->lessons()->syncWithoutDetaching([
            $lesson->id => [
                'completed_at' => now()
            ]
        ]);

        return redirect()
            ->route('curso.ver', $course->slug)
            ->with('success', 'Lección marcada como completada ✅');
    }
}
