<x-app-layout>

    {{-- Header del curso --}}
    <div class="py-8 border-b border-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('mi.espacio') }}"
              class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold
                      bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 transition mb-6">
                ← Volver a Mis Cursos
            </a>

            <h1 class="text-2xl font-bold text-gray-900">
                {{ $course->title }}
            </h1>
            <p class="text-gray-700 mb-6 leading-relaxed">
                {{ $course->description }}
            </p>

            <div class="mt-4">
                <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
                    <span>Progreso del curso</span>
                    <span>45%</span>
                </div>

                <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-2 rounded-full transition-all duration-500"
                         style="width: 45%; background: #22c55e;">
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
                <div class="brand-card bg-white p-5 sticky top-24">

                    <h2 class="text-lg font-semibold mb-4">Contenido del curso</h2>

                    {{-- Módulo 1 --}}
                    @forelse($course->modules as $module)
                        <div class="mb-6">

                            <p class="text-sm font-semibold text-gray-500 mb-2">
                                {{ $module->title }}
                            </p>

                            <ul class="space-y-2 text-sm">
                                @forelse($module->lessons as $lesson)
                                    <li
                                        class="lesson-item flex items-center gap-2 text-gray-600 hover:text-orange-600 transition cursor-pointer"
                                        data-title="{{ $lesson->title }}"
                                        data-content="{{ $lesson->content }}"
                                        data-video="{{ $lesson->video_url }}"
                                        data-pdf="{{ $lesson->pdf_file }}"
                                    >
                                        ▶ {{ $lesson->title }}
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
                <div class="brand-card bg-white p-8">

                    <h2 id="lesson-title" class="text-xl font-bold mb-4">
                        Selecciona una lección
                    </h2>

                    <div id="lesson-video" class="w-full aspect-video bg-gray-200 rounded-lg flex items-center justify-center mb-6">
                        <span class="text-gray-500">Aquí se mostrará el video</span>
                    </div>

                    <div id="lesson-content" class="text-gray-700 mb-6 leading-relaxed">
                        El contenido de la lección aparecerá aquí.
                    </div>

                    <div id="pdf-container" class="hidden mt-6">
                        <h3 class="font-semibold mb-2 text-gray-700">Material de la lección</h3>

                        <iframe id="pdf-viewer"
                            class="w-full h-[500px] rounded-lg border"
                            src=""
                        ></iframe>

                        <a id="lesson-pdf" href="#" target="_blank"
                        class="inline-block mt-3 text-sm font-semibold text-orange-600 hover:underline">
                            Descargar PDF
                        </a>
                    </div>

                    <button
                        class="brand-cta px-6 py-3 rounded-lg font-semibold text-white"
                        style="background: var(--brand);">
                        Marcar como completada
                    </button>

                </div>
            </main>

        </div>
    </div>

    <script>
    document.querySelectorAll('.lesson-item').forEach(item => {
        item.addEventListener('click', function () {
            const title = this.dataset.title;
            const content = this.dataset.content;
            const video = this.dataset.video;
            const pdf = this.dataset.pdf;

            // Título
            document.getElementById('lesson-title').innerText = title;

            // Contenido
            document.getElementById('lesson-content').innerHTML = content ?? 'Sin descripción disponible.';

            // Video (YouTube y Vimeo)
            const lessonVideo = document.getElementById('lesson-video');

            if (video) {
                let embedUrl = '';

                if (video.includes('youtube') || video.includes('youtu.be')) {
                    const id = extractYoutubeId(video);
                    if (id) embedUrl = `https://www.youtube.com/embed/${id}`;
                } else if (video.includes('vimeo')) {
                    const id = extractVimeoId(video);
                    if (id) embedUrl = `https://player.vimeo.com/video/${id}`;
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
                    lessonVideo.innerHTML = `
                        <span class="text-gray-400">
                            El enlace de video no es válido o no es compatible.
                        </span>`;
                }
            } else {
                lessonVideo.innerHTML = `
                    <span class="text-gray-400">
                        Esta lección no tiene video.
                    </span>`;
            }

            function extractVimeoId(url) {
                const match = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
                return match ? match[1] : '';
            }

            // PDF
            const pdfContainer = document.getElementById('pdf-container');
            const pdfViewer = document.getElementById('pdf-viewer');
            const pdfLink = document.getElementById('lesson-pdf');

            if (pdf) {
                const pdfUrl = `/storage/${pdf}`;
                pdfViewer.src = pdfUrl;
                pdfLink.href = pdfUrl;
                pdfContainer.classList.remove('hidden');
            } else {
                pdfContainer.classList.add('hidden');
            }

        });
    });

    // Función para sacar ID de YouTube
    function extractYoutubeId(url) {
        const regExp = /(?:youtube\.com\/.*v=|youtu\.be\/)([^&]+)/;
        const match = url.match(regExp);
        return match ? match[1] : url;
    }
    </script>

</x-app-layout>
