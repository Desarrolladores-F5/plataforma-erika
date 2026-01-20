<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="brand-title">
                Mi Espacio
            </h2>
            <p class="brand-subtitle mt-1">
                Bienvenido/a, {{ Auth::user()->name }}. Aquí encontrarás tus cursos y recursos.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Has iniciado sesión correctamente.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
