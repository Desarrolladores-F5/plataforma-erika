<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;

class DemoCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1) Crear curso DEMO
        $course = Course::create([
            'title' => 'Curso de Autoconocimiento y Bienestar – DEMO',
            'slug' => 'autoconocimiento-demo',
            'description' => 'Este es un curso de prueba que te permitirá visualizar cómo se verá la plataforma cuando exista contenido real.',
            'price' => 0,
            'banner_url' => 'https://picsum.photos/seed/demo-banner/1200/400',
            'promo_video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'is_published' => true,
        ]);

        // 2) Crear módulos
        $module1 = Module::create([
            'course_id' => $course->id,
            'title' => 'Introducción al Curso',
            'order' => 1,
        ]);

        $module2 = Module::create([
            'course_id' => $course->id,
            'title' => 'Herramientas de Bienestar',
            'order' => 2,
        ]);

        // 3) Crear lecciones
        Lesson::create([
            'module_id' => $module1->id,
            'title' => 'Bienvenida al curso',
            'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module1->id,
            'title' => '¿Qué aprenderás?',
            'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module2->id,
            'title' => 'Ejercicio de respiración consciente',
            'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module2->id,
            'title' => 'Técnicas de autocuidado',
            'video_url' => 'https://youtu.be/dQw4w9WgXcQ',
            'order' => 2,
        ]);

        // 4) Matricular automáticamente a Sergio para pruebas
        $sergio = User::where('email', 'sergioarnado@gmail.com')->first();

        if ($sergio) {
            $sergio->courses()->syncWithoutDetaching([$course->id]);
        }

        // 5) Matricular a Erika también
        $erika = User::where('email', 'contacto@erikaherrera.cl')->first();

        if ($erika) {
            $erika->courses()->syncWithoutDetaching([$course->id]);
        }
    }
}
