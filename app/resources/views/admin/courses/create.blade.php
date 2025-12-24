@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Crear curso</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-800">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full border rounded p-2" required>
            <p class="text-sm text-gray-500 mt-1">Ej: curso-laravel-basico</p>
        </div>

        <div>
            <label class="block font-medium mb-1">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded p-2">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Precio</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', 0) }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_published" value="1" id="is_published"
                   class="h-4 w-4" {{ old('is_published') ? 'checked' : '' }}>
            <label for="is_published" class="font-medium">Publicado</label>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.courses.index') }}"
               class="px-4 py-2 rounded border">Volver</a>

            <button type="submit"
                    class="px-4 py-2 rounded bg-black text-white">
                Guardar curso
            </button>
        </div>
    </form>
</div>
@endsection