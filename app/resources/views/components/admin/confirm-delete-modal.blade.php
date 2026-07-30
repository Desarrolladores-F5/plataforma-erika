@props([
    'title' => 'Eliminar elemento',
    'message' => '¿Estás seguro de que deseas continuar?',
])

<div
    x-show="open"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm px-4"
    style="display: none;"
    @keydown.escape.window="open = false"
>

    {{-- Modal --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.away="open = false"
        class="w-full max-w-lg rounded-3xl bg-white shadow-2xl overflow-hidden"
    >

        {{-- Encabezado --}}
        <div class="bg-red-50 px-8 py-6 text-center border-b">

            <div
                class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-100"
            >
                <span class="text-5xl">
                    ⚠️
                </span>
            </div>

            <h2 class="mt-5 text-2xl font-bold text-gray-900">
                {{ $title }}
            </h2>

            <p class="mt-3 text-gray-600">
                {{ $message }}
            </p>

        </div>

        {{-- Contenido --}}
        <div class="px-8 py-6">

            <div class="mx-auto max-w-md text-left">

                <p class="mb-4 font-semibold text-gray-700">
                    Esta acción eliminará permanentemente:
                </p>

                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center gap-3">
                        <span class="shrink-0">✅</span>
                        <span>Curso</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="shrink-0">✅</span>
                        <span>Módulos</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="shrink-0">✅</span>
                        <span>Lecciones</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="shrink-0">✅</span>
                        <span>Compras asociadas</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="shrink-0">✅</span>
                        <span>Certificados relacionados</span>
                    </li>
                </ul>

            </div>

            <div class="mt-6 rounded-xl border border-yellow-300 bg-yellow-50 p-4 text-center">
                <p class="text-sm font-semibold text-yellow-800">
                    Esta acción es irreversible y no se puede deshacer.
                </p>
            </div>

        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-3 px-8 py-6 bg-gray-50 border-t">

            <button
                type="button"
                @click="open = false"
                class="px-5 py-2.5 rounded-xl bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition"
            >
                Cancelar
            </button>

            {{ $slot }}

        </div>

    </div>

</div>