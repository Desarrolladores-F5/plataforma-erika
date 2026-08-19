<x-app-layout>

    {{-- Header del curso --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Cabecera del curso --}}
    <div class="py-8 border-b border-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Volver --}}
            <a href="{{ route('mi.espacio') }}"
            class="inline-flex items-center gap-2
                    px-4 py-2 mb-7
                    rounded-full
                    text-sm font-semibold
                    bg-white border border-gray-200
                    text-gray-700
                    shadow-sm
                    transition-all duration-200
                    hover:bg-gray-50 hover:shadow-md hover:-translate-y-0.5">
                ← Volver a Mis Cursos
            </a>

            {{-- Información principal --}}
            <div class="relative bg-white border border-gray-200 rounded-2xl shadow-sm p-6 md:p-8 overflow-hidden">

                {{-- Acento de marca --}}
                <div class="absolute top-0 left-0 w-full h-1"
                    style="background: var(--brand);">
                </div>

                <div class="max-w-4xl">

                    <p class="text-sm font-semibold text-orange-600 mb-2">
                        Mi aprendizaje
                    </p>

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight">
                        {{ $course->title }}
                    </h1>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        {{ $course->description }}
                    </p>

                </div>

                {{-- Progreso --}}
                <div class="mt-8 pt-6 border-t border-gray-100">

                    <div class="flex items-end justify-between gap-4 mb-3">

                        <div>
                            <p class="text-sm font-semibold text-gray-800">
                                Progreso del curso
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Continúa avanzando a tu ritmo
                            </p>
                        </div>

                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-900">
                                {{ $progress }}%
                            </span>

                            <p class="text-xs text-gray-500">
                                completado
                            </p>
                        </div>

                    </div>

                    <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">

                        <div
                            class="h-full rounded-full transition-all duration-500"
                            style="width: {{ $progress }}%; background: #22c55e;">
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- Layout principal --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- Sidebar de módulos --}}
            <aside class="lg:col-span-1">
                <div class="relative bg-white border border-gray-200 rounded-2xl shadow-sm p-5 sticky top-24 overflow-hidden">

                    {{-- Acento de marca --}}
                    <div class="absolute top-0 left-0 w-full h-1"
                        style="background: var(--brand);">
                    </div>

                    <h2 class="text-lg font-semibold mb-4">Contenido del curso</h2>

                    @forelse($course->modules as $module)
                        <div class="mb-6">

                            <p class="text-sm font-semibold text-gray-500 mb-2">
                                {{ $module->title }}
                            </p>

                            <ul class="space-y-2 text-sm">
                                @forelse($module->lessons as $lesson)

                                    @php
                                        // ¿Esta lección ya fue completada?
                                        $isCompleted = $completedLessonIds->contains($lesson->id);

                                        // ¿Esta es la siguiente lección que corresponde realizar?
                                        $isNext = $nextLessonId === $lesson->id;

                                        // Una lección está disponible si:
                                        // 1. Ya fue completada, o
                                        // 2. Es la siguiente que corresponde realizar.
                                        $isUnlocked = $isCompleted || $isNext;

                                        // Lección que actualmente se está mostrando
                                        $isActive = isset($currentLesson)
                                            && $currentLesson->id === $lesson->id;
                                    @endphp

                                    <li>

                                        @if($isUnlocked)

                                            {{-- LECCIÓN DISPONIBLE --}}
                                            <a
                                                href="#"
                                                class="lesson-item group flex items-center gap-3
                                                    px-3 py-2.5 rounded-xl
                                                    transition-all duration-200
                                                    {{ $isActive
                                                        ? 'bg-orange-50 text-orange-600 font-semibold'
                                                        : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600'
                                                    }}"
                                                data-lesson="{{ $lesson->id }}"
                                                data-title="{{ $lesson->title }}"
                                                data-content="{{ $lesson->content }}"
                                                data-video="{{ $lesson->video_url }}"
                                                data-pdf="{{ $lesson->pdf_file }}"
                                            >

                                                {{-- Indicador --}}
                                                <span class="flex-shrink-0 flex items-center justify-center
                                                            w-6 h-6 rounded-lg text-xs
                                                            {{ $isActive
                                                                ? 'bg-orange-100 text-orange-600'
                                                                : ($isCompleted
                                                                    ? 'bg-green-50 text-green-600'
                                                                    : 'bg-gray-100 text-gray-500 group-hover:bg-orange-50 group-hover:text-orange-600')
                                                            }}">

                                                    @if($isCompleted)
                                                        ✓
                                                    @elseif($isActive || $isNext)
                                                        ▶
                                                    @else
                                                        ○
                                                    @endif

                                                </span>

                                                <span class="leading-snug">
                                                    {{ $lesson->title }}
                                                </span>

                                            </a>

                                        @else

                                            {{-- LECCIÓN BLOQUEADA --}}
                                            <div
                                                class="flex items-center gap-3
                                                    px-3 py-2.5 rounded-xl
                                                    text-gray-400
                                                    cursor-not-allowed
                                                    select-none"
                                                title="Completa la lección anterior para continuar"
                                            >

                                                {{-- Candado --}}
                                                <span class="flex-shrink-0 flex items-center justify-center
                                                            w-6 h-6 rounded-lg
                                                            bg-gray-100 text-gray-400 text-xs">
                                                    🔒
                                                </span>

                                                <span class="leading-snug">
                                                    {{ $lesson->title }}
                                                </span>

                                            </div>

                                        @endif

                                    </li>

                                @empty

                                    <li class="text-gray-400 italic">
                                        (Este módulo aún no tiene lecciones)
                                    </li>

                                @endforelse
                            </ul>

                        </div>

                    @empty

                        <p class="text-gray-400 italic">
                            Este curso aún no tiene módulos creados.
                        </p>

                    @endforelse                   

                </div>
            </aside>


            {{-- Área de contenido de la lección --}}
            <main class="lg:col-span-3">
                <div class="brand-card relative bg-white border border-gray-200 rounded-2xl shadow-sm p-8 overflow-hidden">

                    {{-- Acento de marca --}}
                    <div class="absolute top-0 left-0 w-full h-1"
                        style="background: var(--brand);">
                    </div>

                    {{-- Encabezado de la lección --}}
                    <div class="mb-6">

                        <p class="text-sm font-semibold text-orange-600 mb-2">
                            Lección actual
                        </p>

                        <h2 id="lesson-title"
                            class="text-2xl font-bold text-gray-900 leading-tight">
                            Selecciona una lección
                        </h2>

                    </div>

                    <div id="lesson-video" class="w-full aspect-video bg-gray-200 rounded-lg flex items-center justify-center mb-6">
                        <span class="text-gray-500">Aquí se mostrará el video</span>
                    </div>

                    {{-- Descripción de la lección --}}
                    <div class="mt-7 mb-8">

                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-1 h-5 rounded-full"
                                style="background: var(--brand);">
                            </span>

                            <h3 class="font-semibold text-gray-900">
                                Acerca de esta lección
                            </h3>
                        </div>

                        <div id="lesson-content"
                            class="text-gray-600 leading-relaxed">
                            El contenido de la lección aparecerá aquí.
                        </div>

                    </div>

                    {{-- Material complementario --}}
                    <div id="pdf-container" class="hidden mt-8 pt-7 border-t border-gray-100">

                        <div class="mb-4">
                            <p class="text-sm font-semibold text-orange-600 mb-1">
                                Material complementario
                            </p>

                            <h3 class="text-lg font-bold text-gray-900">
                                Material de la lección
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Revisa o descarga el documento de apoyo asociado a esta lección.
                            </p>
                        </div>

                        {{-- Tarjeta del documento --}}
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
                                    gap-5 p-5
                                    border border-gray-200
                                    rounded-2xl
                                    bg-gray-50">

                            {{-- Información del documento --}}
                            <div class="flex items-center gap-4">

                                <div class="flex items-center justify-center
                                            w-12 h-12
                                            rounded-xl
                                            bg-orange-100
                                            text-orange-600
                                            text-xl
                                            flex-shrink-0">
                                    📄
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-900">
                                        Documento de apoyo
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Material complementario en formato PDF
                                    </p>
                                </div>

                            </div>

                            {{-- Acciones --}}
                            <div class="flex flex-wrap gap-3">

                                <a
                                    id="lesson-pdf-view"
                                    href="#"
                                    target="_blank"
                                    class="inline-flex items-center justify-center
                                        px-4 py-2.5
                                        rounded-xl
                                        border border-gray-300
                                        bg-white
                                        text-sm font-semibold text-gray-700
                                        transition-all duration-200
                                        hover:bg-gray-100 hover:-translate-y-0.5">
                                    Ver PDF
                                </a>

                                <a
                                    id="lesson-pdf"
                                    href="#"
                                    download
                                    class="inline-flex items-center justify-center gap-2
                                        px-4 py-2.5
                                        rounded-xl
                                        border border-orange-200
                                        bg-white
                                        text-sm font-semibold text-orange-600
                                        transition-all duration-200
                                        hover:bg-orange-50 hover:-translate-y-0.5">

                                    <span>↓</span>
                                    Descargar PDF
                                </a>

                            </div>

                        </div>

                    </div>

                    <form method="POST" id="complete-form" action="" class="mt-8">
                        @csrf

                        <button
                            type="submit"
                            class="brand-cta px-6 py-3 rounded-lg font-semibold text-white hover:scale-105 transition"
                            style="background: var(--brand);">
                            Marcar como completada
                        </button>
                    </form>
                </div>
            </main>

        </div>

       @if($courseCompleted)
            <div class="mt-12 p-6 rounded-xl bg-green-50 border border-green-300 text-center">

                <h3 class="text-2xl font-bold text-green-800 mb-2">
                    🎉 Felicitaciones, has completado el curso
                </h3>

                <p class="text-green-700 mb-4">
                    Has finalizado exitosamente el curso
                    <strong>{{ $course->title }}</strong>.
                </p>

                <a href="{{ route('certificado.descargar', $course->id) }}"
                    target="_blank"
                    class="inline-flex items-center justify-center gap-2
                            px-6 py-3 rounded-lg font-semibold
                            bg-orange-500 text-white
                            transition-transform duration-150
                            hover:bg-orange-600 hover:scale-105 hover:text-white">
                    🧾 <span class="text-white hover:text-white">Descargar Certificado</span>
                </a>

                <p class="mt-4 text-sm text-gray-700">
                    📞 Para coordinar tu sesión personalizada de coaching con
                    <strong>Erika Herrera</strong>, contáctala directamente al:<br>
                    <strong>+56 9 54082624</strong>
                </p>

            </div>
        @endif

    </div>

    <script>
        document.querySelectorAll('.lesson-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();

                // Quitar resaltado anterior
                document.querySelectorAll('.lesson-item').forEach(el => {
                    el.classList.remove('text-orange-600', 'font-semibold');
                    el.classList.add('text-gray-600');
                });

                // Marcar activa
                this.classList.remove('text-gray-600');
                this.classList.add('text-orange-600', 'font-semibold');

                const lessonId = this.dataset.lesson;
                const title = this.dataset.title;
                const content = this.dataset.content;
                const video = this.dataset.video;
                const pdf = this.dataset.pdf;

                // 🔥 ACTUALIZA EL FORM CON LA LECCIÓN CORRECTA
                const form = document.getElementById('complete-form');
                form.action = `/curso/{{ $course->slug }}/leccion/${lessonId}/completar`;

                // Título
                document.getElementById('lesson-title').innerText = title;

                // Contenido
                document.getElementById('lesson-content').innerHTML = content ?? 'Sin descripción disponible.';

                // VIDEO
                const lessonVideo = document.getElementById('lesson-video');
                let embedUrl = '';

                if (video) {
                    if (video.includes('youtube') || video.includes('youtu.be')) {
                        const id = extractYoutubeId(video);
                        if (id) embedUrl = `https://www.youtube.com/embed/${id}`;
                    } 
                    else if (video.includes('vimeo')) {
                        const id = extractVimeoId(video);
                        if (id) embedUrl = `https://player.vimeo.com/video/${id}`;
                    }
                }

                if (embedUrl) {
                    lessonVideo.innerHTML = `
                        <iframe class="w-full h-full rounded-lg"
                            src="${embedUrl}"
                            frameborder="0"
                            allowfullscreen
                            allow="autoplay; fullscreen; picture-in-picture">
                        </iframe>`;
                } else {
                    lessonVideo.innerHTML = `<span class="text-gray-400">Esta lección no tiene video.</span>`;
                }

                // PDF
                const pdfContainer = document.getElementById('pdf-container');
                const pdfViewLink = document.getElementById('lesson-pdf-view');
                const pdfLink = document.getElementById('lesson-pdf');

                if (pdf) {
                    const pdfUrl = `/storage/${pdf}`;

                    pdfViewLink.href = pdfUrl;
                    pdfLink.href = pdfUrl;

                    pdfContainer.classList.remove('hidden');
                } else {
                    pdfContainer.classList.add('hidden');
                }

            });
            
        });

        // YouTube ID
        function extractYoutubeId(url) {
            const regExp = /(?:youtube\.com\/.*v=|youtu\.be\/)([^&]+)/;
            const match = url.match(regExp);
            return match ? match[1] : '';
        }

        // Vimeo ID
        function extractVimeoId(url) {
            const match = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
            return match ? match[1] : '';
        }

        // 🔥 AUTO CARGAR LA LECCIÓN ACTIVA AL ENTRAR
        const activeLesson = document.querySelector('.lesson-item.text-orange-600');
        if (activeLesson) activeLesson.click();

    </script>

</x-app-layout>
