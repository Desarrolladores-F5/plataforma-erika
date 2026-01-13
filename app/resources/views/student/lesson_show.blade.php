@extends('layouts.base')   

@section('content')

{{-- Breadcrumb --}}
<div class="max-w-6xl mx-auto px-6 py-2">
    <nav class="text-sm text-gray-500  mb-4 flex flex-wrap items-center gap-1">
        <a href="{{ route('home') }}" class="hover:text-orange-600">
                Inicio
        </a>
        <span>/</span>

        <a href="{{ route('curso.detalle', $course->slug) }}" class="hover:text-orange-600">
            {{ $course->title }}
        </a>
        <span>/</span>

        <a href="{{ route('curso.detalle', $course->slug) }}#modulo-{{ $module->id }}"
            class="hover:text-orange-600">
            {{ $module->title }}
        </a>
        <span>/</span>

        <span class="text-gray-900 font-semibold">
            {{ $lesson->title }}
        </span>
    </nav>
</div>

<div class="max-w-4xl mx-auto py-10 px-6">

    <a href="{{ route('curso.detalle', $course->slug) }}"
       class="text-sm text-gray-600 hover:underline">
        ← Volver al curso
    </a>

    <h1 class="text-2xl font-bold mt-4">
        {{ $lesson->title }}
    </h1>

    @php
    $isCompleted = auth()->check()
        ? auth()->user()
            ->completedLessons()
            ->where('lessons.id', $lesson->id)
            ->wherePivotNotNull('completed_at')
            ->exists()
        : false;
    @endphp

    @if(auth()->check())
        @if(!$isCompleted)
            <form method="POST"
                action="{{ route('lesson.complete', [$course->slug, $lesson->id]) }}"
                class="mt-4">
                @csrf
                <button type="submit"
                    class="px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700 transition">
                    ✅ Marcar como completada
                </button>
            </form>
        @else
            <div class="mt-4 mb-6 inline-flex items-center gap-2
                px-4 py-2 rounded-lg
                bg-green-100 text-green-800
                font-semibold text-sm">
                ✅ Lección completada
            </div>>
        @endif
    @endif

   @if($lesson->video_url)
        @php
            $embedUrl = null;

            // 🎥 YouTube
            if (str_contains($lesson->video_url, 'youtube.com')) {
                parse_str(parse_url($lesson->video_url, PHP_URL_QUERY), $vars);
                if (!empty($vars['v'])) {
                    $embedUrl = 'https://www.youtube.com/embed/' . $vars['v'];
                }
            } elseif (str_contains($lesson->video_url, 'youtu.be')) {
                $videoId = trim(parse_url($lesson->video_url, PHP_URL_PATH), '/');
                $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
            }

            // 🎬 Vimeo
            elseif (str_contains($lesson->video_url, 'vimeo.com')) {
                $videoId = trim(parse_url($lesson->video_url, PHP_URL_PATH), '/');
                if (is_numeric($videoId)) {
                    $embedUrl = 'https://player.vimeo.com/video/' . $videoId;
                }
            }
        @endphp

        @if($embedUrl)
            <div class="my-6 aspect-video bg-black rounded-xl overflow-hidden shadow">
                <iframe
                    class="w-full h-full"
                    src="{{ $embedUrl }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            <p class="text-sm text-gray-500 mt-2">
                Si el video no se reproduce aquí,
                <a href="{{ $lesson->video_url }}" target="_blank" class="text-orange-600 underline">
                    verlo en la plataforma original
                </a>
            </p>
        @endif
    @endif

    {{-- CONTENIDO --}}
    @if($lesson->content)
        <div class="prose max-w-none mt-6">
            {!! nl2br(e($lesson->content)) !!}
        </div>
    @endif

    {{-- PDF --}}
    @if($lesson->pdf_file && $userHasAccess)
        <div class="my-8">
            <h3 class="text-lg font-semibold mb-3">
                📄 Material descargable
            </h3>

            {{-- Visor PDF --}}
            <div class="w-full h-[70vh] border rounded-xl overflow-hidden shadow bg-gray-100">
                <iframe
                    src="{{ asset('storage/'.$lesson->pdf_file) }}"
                    class="w-full h-full"
                    frameborder="0">
                </iframe>
            </div>

            {{-- Acciones --}}
            <div class="mt-4 flex gap-4 flex-wrap">
                <a
                    href="{{ asset('storage/'.$lesson->pdf_file) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold shadow hover:bg-orange-600 transition"
                >
                    ⬇ Descargar PDF
                </a>

                <a
                    href="{{ asset('storage/'.$lesson->pdf_file) }}"
                    target="_blank"
                    class="text-sm text-gray-600 underline self-center"
                >
                    Abrir en pestaña nueva
                </a>
            </div>
        </div>
    @endif

    {{-- BLOQUEO --}}
    @if(!$userHasAccess && !$lesson->is_preview)
        <div class="mt-6 p-4 bg-yellow-100 text-yellow-800 rounded">
            🔒 Compra el curso para acceder a esta lección.
        </div>
    @endif

    @php
        $nextLesson = auth()->check()
            ? $course->nextLessonForUser(auth()->user())
            : null;
    @endphp

    @if($nextLesson)
        <div class="mt-12 flex justify-end">
            <a href="{{ route('lesson.show', [$course->slug, $nextLesson->id]) }}"
               class="inline-flex items-center gap-3
                      px-6 py-4 rounded-xl
                      bg-orange-500 text-white
                      font-bold text-lg
                      shadow-md
                      hover:bg-orange-600 hover:scale-[1.02]
                      transition">
                ▶ Ir a la siguiente lección
            </a>
        </div>
    @else
        <div class="mt-12 text-center">
            <p class="text-lg font-semibold text-green-700">
                🎉 Has completado todas las lecciones del curso
            </p>
            <p class="text-sm text-gray-600 mt-1">
                El certificado estará disponible cuando completes el curso al 100%
            </p>
        </div>
    @endif
    
</div>
@endsection
