@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Cursos</h1>

        <a href="{{ route('admin.courses.create') }}"
           class="px-4 py-2 rounded bg-black text-white">
            + Crear curso
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left p-3">Título</th>
                    <th class="text-left p-3">Slug</th>
                    <th class="text-right p-3">Precio</th>
                    <th class="text-center p-3">Publicado</th>
                    <th class="text-right p-3">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($courses as $course)
                    <tr class="border-t">
                        <td class="p-3 font-medium">
                            {{ $course->title }}
                        </td>

                        <td class="p-3 text-gray-600">
                            {{ $course->slug }}
                        </td>

                        <td class="p-3 text-right">
                            ${{ number_format((float)($course->price ?? 0), 0, ',', '.') }}
                        </td>

                        <td class="p-3 text-center">
                            @if($course->is_published)
                                <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800">
                                    Sí
                                </span>
                            @else
                                <span class="inline-block px-2 py-1 rounded bg-gray-100 text-gray-700">
                                    No
                                </span>
                            @endif
                        </td>

                        <td class="p-3 text-right">
                            <a href="{{ route('admin.courses.edit', $course) }}"
                               class="px-3 py-1 rounded border">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t">
                        <td class="p-6 text-center text-gray-600" colspan="5">
                            No hay cursos aún. Crea el primero con “Crear curso”.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
