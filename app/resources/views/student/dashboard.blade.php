<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="brand-title">Mis Cursos</h1>
                <p class="brand-subtitle mt-1">
                    Accede a tus cursos activos y continúa tu aprendizaje
                </p>
            </div>


            @if($courses->count() === 0)
                <div class="brand-card card-appear bg-white p-8 text-center">
                    <p class="text-gray-600 text-lg">
                        No tienes cursos todavía. ¡Explora el catálogo!
                    </p>
                </div>
            @else

                {{-- ========================================================= --}}
                {{-- TARJETAS DE MIS CURSOS --}}
                {{-- ========================================================= --}}

                <div class="grid gap-8 md:grid-cols-2">
                    @foreach($courses as $i => $course)

                        @php
                            // Total de lecciones del curso
                            $totalLessons = $course->modules->sum(function ($module) {
                                return $module->lessons->count();
                            });

                            // IDs de las lecciones del curso
                            $lessonIds = $course->modules->flatMap->lessons->pluck('id');

                            // Lecciones completadas por el alumno
                            $completedLessons = auth()->user()
                                ->completedLessons()
                                ->whereIn('lesson_id', $lessonIds)
                                ->count();

                            // Porcentaje de progreso
                            $progress = $totalLessons > 0
                                ? round(($completedLessons / $totalLessons) * 100)
                                : 0;

                            // Badge según progreso
                            if ($progress >= 90) {
                                $statusText = 'Completado';
                                $statusClasses = 'bg-green-100 text-green-700';
                                $statusIcon = '✓';
                            } elseif ($progress >= 20) {
                                $statusText = 'En progreso';
                                $statusClasses = 'bg-blue-100 text-blue-700';
                                $statusIcon = '⏳';
                            } else {
                                $statusText = 'Nuevo';
                                $statusClasses = 'bg-gray-100 text-gray-700';
                                $statusIcon = '✨';
                            }

                            // CTA inteligente
                            if ($progress >= 90) {
                                $ctaText = 'Revisar';
                                $ctaColor = '#64748b';
                            } elseif ($progress >= 20) {
                                $ctaText = 'Continuar';
                                $ctaColor = 'var(--brand)';
                            } else {
                                $ctaText = 'Empezar';
                                $ctaColor = '#16a34a';
                            }
                        @endphp


                        {{-- Tarjeta del curso --}}
                        <article
                            class="brand-card card-appear stagger group
                                relative overflow-hidden
                                bg-white border border-gray-200
                                rounded-2xl shadow-sm
                                flex flex-col
                                transition-all duration-300 ease-out
                                hover:-translate-y-2
                                hover:shadow-xl"
                            style="--i: {{ $i }};"
                        >

                            {{-- Acento superior de marca --}}
                            <div
                                class="absolute top-0 left-0 w-full h-1
                                    transition-all duration-300 ease-out
                                    group-hover:h-1.5"
                                style="background: var(--brand);">
                            </div>

                            {{-- Contenido principal --}}
                            <div class="p-7 flex flex-col flex-1">

                                {{-- Estado --}}
                                <div class="mb-5">
                                    <span
                                        class="inline-flex items-center gap-2
                                            px-3 py-1.5
                                            text-xs font-semibold
                                            rounded-full
                                            {{ $statusClasses }}"
                                    >
                                        <span>{{ $statusIcon }}</span>
                                        <span>{{ $statusText }}</span>
                                    </span>
                                </div>


                                {{-- Información del curso --}}
                                <div class="mb-6">

                                    <h3 class="text-xl font-bold text-gray-900 leading-tight mb-3">
                                        {{ $course->title }}
                                    </h3>

                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        {{ $course->description }}
                                    </p>

                                </div>


                                {{-- Separador --}}
                                <div class="border-t border-gray-100 mt-auto pt-5">

                                    {{-- Progreso --}}
                                    <div class="mb-5">

                                        <div class="flex items-end justify-between mb-2">

                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">
                                                    Progreso del curso
                                                </p>

                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    @if($progress >= 90)
                                                        Curso completado
                                                    @elseif($progress >= 20)
                                                        Continúa donde lo dejaste
                                                    @else
                                                        Todo listo para comenzar
                                                    @endif
                                                </p>
                                            </div>

                                            <span class="text-lg font-bold text-gray-900">
                                                {{ $progress }}%
                                            </span>

                                        </div>


                                        {{-- Barra de progreso --}}
                                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">

                                            <div
                                                class="h-full rounded-full transition-all duration-500"
                                                style="
                                                    width: {{ $progress }}%;
                                                    background: #22c55e;
                                                ">
                                            </div>

                                        </div>

                                    </div>


                                    {{-- CTA --}}
                                    <a
                                        href="{{ route('curso.ver', $course->slug) }}"
                                        class="brand-cta
                                            w-full
                                            inline-flex items-center justify-center
                                            px-5 py-3
                                            rounded-xl
                                            font-semibold text-white
                                            transition-all duration-200
                                            hover:-translate-y-0.5 hover:shadow-md"
                                        style="background: {{ $ctaColor }};"
                                    >
                                        {{ $ctaText }}

                                        @if($progress >= 20 && $progress < 90)
                                            <span class="ml-2">→</span>
                                        @endif
                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach
                </div>

            @endif
        </div>
    </div>

    {{-- Botón flotante --}}
    <a href="{{ route('home') }}"
       class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-2 px-5 py-3 rounded-full
                text-white font-semibold shadow-lg transition hover:scale-105 hover:text-white focus:text-white"
       style="background: var(--brand);">
         🔍 Explorar cursos
    </a>


</x-app-layout>
