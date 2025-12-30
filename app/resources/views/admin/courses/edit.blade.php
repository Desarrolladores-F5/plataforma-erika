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
</div>
@endsection
