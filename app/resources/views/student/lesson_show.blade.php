@extends('layouts.base')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <a href="{{ route('curso.detalle', $course->slug) }}"
       class="text-sm text-gray-600 hover:underline">
        ← Volver al curso
    </a>

    <h1 class="text-2xl font-bold mt-4">
        {{ $lesson->title }}
    </h1>

    @if($lesson->video_url)
        @php
            $videoId = null;

            if (str_contains($lesson->video_url, 'youtube.com')) {
                parse_str(parse_url($lesson->video_url, PHP_URL_QUERY), $vars);
                $videoId = $vars['v'] ?? null;
            } elseif (str_contains($lesson->video_url, 'youtu.be')) {
                $videoId = trim(parse_url($lesson->video_url, PHP_URL_PATH), '/');
            }
        @endphp

        @if($videoId)
            <div class="my-6 aspect-video">
                <iframe
                    class="w-full h-full rounded-lg"
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>
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
        <div class="mt-6">
            <a href="{{ asset('storage/'.$lesson->pdf_file) }}"
               target="_blank"
               class="inline-block px-4 py-2 bg-orange-500 text-white rounded">
                📄 Descargar PDF
            </a>
        </div>
    @endif

    {{-- BLOQUEO --}}
    @if(!$userHasAccess && !$lesson->is_preview)
        <div class="mt-6 p-4 bg-yellow-100 text-yellow-800 rounded">
            🔒 Compra el curso para acceder a esta lección.
        </div>
    @endif

</div>
@endsection
