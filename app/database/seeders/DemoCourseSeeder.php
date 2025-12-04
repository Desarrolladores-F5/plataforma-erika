<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;

class DemoCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1) Buscamos al alumno de prueba (tú 😊)
        $student = User::where('email', 'sergioarnado@gmail.com')->first();

        if (!$student) {
            $this->command->warn('');
            $this->command->warn('⚠ No se encontró al usuario sergioarnado@gmail.com');
            $this->command->warn('   Regístrate con ese correo y vuelve a ejecutar el seeder.');
            $this->command->warn('');
            return;
        }

        $this->command->info('✅ Usuario de prueba encontrado: ' . $student->name);

        // 2) Creamos / actualizamos el curso DEMO
        $course = Course::updateOrCreate(
            ['slug' => 'curso-autoconocimiento-bienestar-demo'],
            [
                'title'           => 'Curso de Autoconocimiento y Bienestar – DEMO',
                'description'     => 'Este es un curso de prueba que te permitirá visualizar cómo se verá la plataforma cuando exista contenido real.',
                'price'           => 0, // demo gratuito
                'banner_url'      => 'https://picsum.photos/seed/demo-banner/1200/400',
                'promo_video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_published'    => true,
            ]
        );

        $this->command->info('✅ Curso DEMO creado/actualizado (ID: ' . $course->id . ')');

        // 3) Borramos módulos/lecciones anteriores del mismo curso (si los hubiera)
        Module::where('course_id', $course->id)->delete();

        // 4) Creamos los módulos
        $modulesData = [
            [
                'title' => 'Introducción al curso',
                'order' => 1,
            ],
            [
                'title' => 'Módulo 1: Bienestar y emociones',
                'order' => 2,
            ],
            [
                'title' => 'Módulo 2: Autoconocimiento práctico',
                'order' => 3,
            ],
        ];

        $modules = [];

        foreach ($modulesData as $data) {
            $modules[] = Module::create([
                'course_id' => $course->id,
                'title'     => $data['title'],
                'order'     => $data['order'],
            ]);
        }

        $this->command->info('✅ Módulos creados: ' . count($modules));

        // 5) Creamos lecciones de ejemplo para cada módulo
        //    (usamos el mismo video de ejemplo; luego Erika pondrá los reales)
        foreach ($modules as $index => $module) {
            if ($index === 0) {
                // Módulo de introducción
                Lesson::create([
                    'module_id'  => $module->id,
                    'title'      => 'Bienvenida al curso',
                    'order'      => 1,
                    'video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content'    => 'En esta lección daremos la bienvenida y explicaremos cómo aprovechar al máximo el curso.',
                    'is_preview' => true,
                ]);
            } elseif ($index === 1) {
                // Módulo 1
                Lesson::create([
                    'module_id'  => $module->id,
                    'title'      => 'Gestionando tus emociones',
                    'order'      => 1,
                    'video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content'    => 'Ejercicio guiado para identificar y nombrar tus emociones diarias.',
                    'is_preview' => false,
                ]);

                Lesson::create([
                    'module_id'  => $module->id,
                    'title'      => 'Rutinas de bienestar',
                    'order'      => 2,
                    'video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content'    => 'Pequeños hábitos diarios para mejorar tu bienestar general.',
                    'is_preview' => false,
                ]);
            } elseif ($index === 2) {
                // Módulo 2
                Lesson::create([
                    'module_id'  => $module->id,
                    'title'      => 'Descubriendo tus fortalezas',
                    'order'      => 1,
                    'video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content'    => 'Ejercicio práctico para reconocer tus recursos internos.',
                    'is_preview' => false,
                ]);

                Lesson::create([
                    'module_id'  => $module->id,
                    'title'      => 'Plan personal de bienestar',
                    'order'      => 2,
                    'video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'content'    => 'Cierre del curso con un plan accionable de bienestar y autoconocimiento.',
                    'is_preview' => false,
                ]);
            }
        }

        $this->command->info('✅ Lecciones creadas.');

        // 6) Matriculamos al alumno de prueba en el curso DEMO
        $student->courses()->syncWithoutDetaching([$course->id]);

        $this->command->info('🎉 ¡Listo! El usuario ' . $student->email . ' ha sido matriculado en el curso DEMO.');
    }
}
