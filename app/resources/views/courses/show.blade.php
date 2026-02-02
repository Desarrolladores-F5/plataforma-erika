<x-app-layout :hideNav="true">

    <div class="max-w-7xl mx-auto px-6 py-20">

        {{-- Volver --}}
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                    bg-white border border-gray-200 text-sm font-medium text-gray-700
                    shadow-sm hover:shadow-md hover:-translate-y-0.5
                    transition mb-10">
                ← Volver al inicio
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Imagen del curso --}}
            <div class="rounded-3xl overflow-hidden shadow-2xl card-appear">
                <img
                    src="{{ $course->banner_url ?: 'https://picsum.photos/seed/demo-banner/1200/800' }}"
                    alt="Portada del curso"
                    class="w-full h-full object-cover hover:scale-105 transition duration-700"
                >
            </div>

            {{-- Información --}}
            <div class="card-appear">

                {{-- Badge --}}
                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 shadow-sm">
                    Curso destacado
                </span>

                {{-- Título --}}
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight brand-title">
                    {{ $course->title }}
                </h1>

                {{-- Descripción --}}
                <p class="text-gray-600 text-lg mb-8 leading-relaxed brand-subtitle">
                    {{ $course->description }}
                </p>

                {{-- Datos rápidos --}}
                <div class="flex gap-12 mb-10 text-sm">
                    <div>
                        <p class="text-gray-500">Duración</p>
                        <p class="font-semibold text-gray-900">4 semanas</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Nivel</p>
                        <p class="font-semibold text-gray-900">Inicial</p>
                    </div>
                </div>

                {{-- CTA principal --}}
                @auth
                    @php
                        $hasAccess = auth()->user()->orders()
                            ->where('course_id', $course->id)
                            ->where('status', 'pagado')
                            ->exists();
                    @endphp

                    @if($hasAccess)
                        <a href="{{ route('curso.ver', $course->id) }}"
                        class="inline-flex items-center justify-center px-8 py-4 rounded-2xl font-semibold text-white shadow-lg transition hover:scale-105 hover:shadow-xl"
                        style="background: var(--brand);">
                            Ir al curso
                        </a>
                    @else
                        <a href="{{ route('checkout.iniciar', $course->slug) }}"
                            class="inline-flex items-center justify-center px-8 py-4 rounded-2xl font-semibold text-white shadow-lg transition hover:scale-105"
                            style="background: var(--brand);">
                            Comprar curso
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center px-8 py-4 rounded-2xl font-semibold text-white shadow-lg transition hover:scale-105 hover:shadow-xl"
                    style="background: var(--brand);">
                        Inicia sesión para comprar
                    </a>
                @endauth

            </div>
        </div>

    </div>
</x-app-layout>
