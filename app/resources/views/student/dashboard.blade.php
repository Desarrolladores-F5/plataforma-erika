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

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($courses as $i => $course)
                        @php
                            // Placeholder visual hasta conectar a BD real
                            $totalLessons = $course->modules->sum(function ($module) {
                                return $module->lessons->count();
                            });

                            $lessonIds = $course->modules->flatMap->lessons->pluck('id');

                            $completedLessons = auth()->user()
                                ->completedLessons()
                                ->whereIn('lesson_id', $lessonIds)
                                ->count();

                            $progress = $totalLessons > 0
                                ? round(($completedLessons / $totalLessons) * 100)
                                : 0;

                            // Badge según progreso
                            if ($progress >= 90) {
                                $statusText = 'Completado';
                                $statusClasses = 'bg-green-100 text-green-700';
                                $statusIcon = '✅';
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
                                $ctaColor = '#64748b'; // gris elegante
                            } elseif ($progress >= 20) {
                                $ctaText = 'Continuar';
                                $ctaColor = 'var(--brand)'; // naranjo Erika
                            } else {
                                $ctaText = 'Empezar';
                                $ctaColor = '#16a34a'; // verde inicio
                            }

                        @endphp

                        <div class="brand-card card-appear stagger bg-white p-6 flex flex-col" style="--i: {{ $i }};">

                            {{-- Badge --}}
                            <span class="inline-flex items-center gap-2 mb-3 px-3 py-1 text-xs font-semibold rounded-full {{ $statusClasses }}">
                                {{ $statusIcon }} {{ $statusText }}
                            </span>


                            <h3 class="text-lg font-semibold mb-2">
                                {{ $course->title }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                {{ $course->description }}
                            </p>

                            {{-- Progreso visual --}}
                            <div class="mb-4">
                                <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                                    <span>Progreso</span>
                                    <span>{{ $progress }}%</span>
                                </div>

                                <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-2 rounded-full transition-all duration-500"
                                         style="width: {{ $progress }}%; background: #22c55e;">
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('curso.ver', $course->id) }}"
                               class="mt-auto inline-flex items-center justify-center px-4 py-2 rounded-lg font-semibold text-white brand-cta"
                               style="background: {{ $ctaColor }};">                                                            
                                {{ $ctaText }}
                            </a>

                        </div>
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
