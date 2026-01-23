<x-app-layout>
    <x-slot name="content">
        <div>
            <h2 class="brand-title">Mis Cursos</h2>
            <p class="brand-subtitle mt-1">
                Accede a tus cursos activos y continúa tu aprendizaje
            </p>
        </div>

        <x-dropdown-link :href="route('profile.edit')">
            Perfil
        </x-dropdown-link>

        <x-dropdown-link :href="route('orders.index')">
            📄 Ver historial de compras
        </x-dropdown-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Cerrar sesión
            </x-dropdown-link>
        </form>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($courses->count() === 0)
                <div class="brand-card bg-white p-8 text-center">
                    <p class="text-gray-600 text-lg">
                        No tienes cursos todavía. ¡Explora el catálogo!
                    </p>
                </div>
            @else

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($courses as $course)
                        <div class="brand-card bg-white p-6 flex flex-col">

                            {{-- Badge --}}
                            <span class="inline-flex items-center gap-2 mb-3 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                ✔ Curso activo
                            </span>

                            <h3 class="text-lg font-semibold mb-2">
                                {{ $course->title }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                {{ $course->description }}
                            </p>

                            <a href="{{ route('curso.detalle', $course->slug) }}"
                               class="mt-auto text-orange-600 font-semibold hover:underline">
                                Continuar curso →
                            </a>

                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </div>

    <a href="{{ route('home') }}"
        class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-2 px-5 py-3 rounded-full
                text-white font-semibold shadow-lg transition
                hover:scale-105"
        style="background: var(--brand);">
            🔍 Explorar cursos
    </a>

</x-app-layout>
