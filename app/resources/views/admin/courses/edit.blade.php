@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Editar curso</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-800">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.courses.update', $course) }}"
          enctype="multipart/form-data"
          class="space-y-4">

        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Título</label>
            <input type="text" name="title"
                   value="{{ old('title', $course->title) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Slug</label>
            <input type="text" name="slug"
                   value="{{ old('slug', $course->slug) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded p-2">{{ old('description', $course->description) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Precio</label>
            <input type="number" step="0.01" name="price"
                   value="{{ old('price', $course->price) }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Video promocional (URL)</label>
            <input type="url" name="promo_video_url"
                   value="{{ old('promo_video_url', $course->promo_video_url) }}"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Thumbnail</label>
            @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}"
                     class="h-20 mb-2 rounded">
            @endif
            <input type="file" name="thumbnail" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Banner</label>
            @if($course->banner_url)
                <img src="{{ asset('storage/' . $course->banner_url) }}"
                     class="h-20 mb-2 rounded">
            @endif
            <input type="file" name="banner_url" class="w-full border rounded p-2">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_published" value="1"
                   {{ old('is_published', $course->is_published) ? 'checked' : '' }}>
            <label class="font-medium">Publicado</label>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.courses.index') }}"
               class="px-4 py-2 rounded border">Volver</a>

            <button type="submit"
                    class="px-4 py-2 rounded bg-black text-white">
                Guardar cambios
            </button>
        </div>
    </form>

    {{-- 👇 AQUÍ VA EL BLOQUE DE MÓDULOS 👇 --}}

    <hr class="my-8">

    <h2 class="text-xl font-semibold mb-4">📦 Módulos del curso</h2>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Crear módulo --}}
    <form method="POST"
        action="{{ route('admin.modules.store', $course) }}"
        class="flex gap-2 mb-6">
        @csrf

        <input type="text"
            name="title"
            placeholder="Título del módulo"
            class="border rounded px-3 py-2 w-full"
            required>

        <button class="px-4 py-2 bg-black text-white rounded">
            + Agregar módulo
        </button>
    </form>

    {{-- Listado de módulos --}}
    <div class="space-y-3">
        @forelse($course->modules as $module)

            {{-- MÓDULO --}}
            <div class="border rounded p-4">

                {{-- Header módulo --}}
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <strong>{{ $module->order }}.</strong> {{ $module->title }}
                    </div>

                    <div class="flex gap-2">
                        {{-- Editar módulo --}}
                        <form method="POST"
                            action="{{ route('admin.modules.update', [$course, $module]) }}"
                            class="flex gap-2">
                            @csrf
                            @method('PUT')

                            <input name="title" value="{{ $module->title }}" class="border rounded px-2 py-1">
                            <input name="order" value="{{ $module->order }}" class="border rounded px-2 py-1 w-20">

                            <button class="px-3 py-1 border rounded">Guardar</button>
                        </form>

                        {{-- Eliminar módulo --}}
                        <form method="POST"
                            action="{{ route('admin.modules.destroy', [$course, $module]) }}"
                            onsubmit="return confirm('¿Eliminar módulo?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 text-red-600 border rounded">Eliminar</button>
                        </form>
                    </div>
                </div>

                {{-- 🔽 LECCIONES DEL MÓDULO --}}
                <div class="ml-6 pl-4 border-l space-y-4">

                    {{-- FORMULARIO AGREGAR LECCIÓN --}}
                    <form method="POST"
                        action="{{ route('admin.lessons.store', [$course, $module]) }}"
                        enctype="multipart/form-data"
                        class="space-y-2 bg-gray-50 p-4 rounded">
                        @csrf

                        <input name="title" placeholder="Título de la lección" class="border rounded px-3 py-2 w-full" required>

                        <textarea name="content" placeholder="Contenido (opcional)"
                                class="border rounded px-3 py-2 w-full"></textarea>

                        <input name="video_url" type="url" placeholder="URL del video" class="border rounded px-3 py-2 w-full">

                        <input name="pdf_file" type="file" accept="application/pdf">

                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="is_preview" value="1">
                            Vista previa gratuita
                        </label>

                        <button class="px-3 py-2 bg-gray-800 text-white rounded">
                            + Agregar lección
                        </button>
                    </form>

                    {{-- LISTADO DE LECCIONES --}}
                    @forelse($module->lessons as $lesson)
                        <div class="border rounded p-3 bg-white flex justify-between">
                            <div>
                                <strong>{{ $lesson->order }}.</strong> {{ $lesson->title }}
                                <div class="text-xs text-gray-600">
                                    {{ $lesson->is_preview ? '🔓 Preview' : '🔒 Privada' }}
                                </div>
                            </div>

                            <form method="POST"
                                action="{{ route('admin.lessons.destroy', [$course, $module, $lesson]) }}"
                                onsubmit="return confirm('¿Eliminar lección?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Eliminar</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-gray-600">
                            Este módulo aún no tiene lecciones.
                        </p>
                    @endforelse

                </div>
            </div>

        @empty
            <p class="text-gray-600">
                Este curso aún no tiene módulos.
            </p>
        @endforelse
    </div>
</div>
@endsection
