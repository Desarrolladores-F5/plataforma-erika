@props([
    'maxWidth' => 'md',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Plataforma Educativa Erika Herrera</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
            href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


    <body class="font-sans text-gray-800 antialiased">

        {{-- =========================================================
            CONTENEDOR PRINCIPAL DE AUTENTICACIÓN
        ========================================================== --}}
        <div class="min-h-screen bg-gray-50 px-4 py-10 sm:px-6 lg:px-8">

            <div class="mx-auto flex min-h-[calc(100vh-5rem)] max-w-6xl items-center justify-center">

                {{-- =================================================
                    CONTENEDOR DE LAS DOS TARJETAS
                ================================================== --}}
                <div class="grid w-full gap-8 lg:grid-cols-2">

                    {{-- =============================================
                        PANEL IZQUIERDO — BIENVENIDA
                    ============================================== --}}
                    <div class="relative flex flex-col justify-center
                                overflow-hidden
                                rounded-3xl
                                border border-gray-200
                                bg-white
                                p-8 sm:p-10 lg:p-14
                                shadow-sm">

                        {{-- Acento superior de marca --}}
                        <div
                            class="absolute left-0 top-0 h-1 w-full"
                            style="background: var(--brand, #ff6b00);">
                        </div>

                        <div class="max-w-md">

                            <p class="mb-3 text-sm font-semibold text-orange-600">
                                Tu espacio de aprendizaje
                            </p>

                            <h1 class="text-3xl font-bold leading-tight text-gray-900 sm:text-4xl">
                                Continúa tu camino de aprendizaje
                            </h1>

                            <p class="mt-5 leading-relaxed text-gray-600">
                                Accede a tus cursos, revisa tu progreso y continúa
                                aprendiendo a tu propio ritmo.
                            </p>

                            {{-- Beneficios --}}
                            <div class="mt-8 space-y-4">

                                <div class="flex items-center gap-3">

                                    <span
                                        class="flex h-9 w-9 flex-shrink-0 items-center justify-center
                                            rounded-xl bg-orange-50 text-orange-600">
                                        ✓
                                    </span>

                                    <span class="text-sm font-medium text-gray-700">
                                        Accede fácilmente a tus cursos
                                    </span>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span
                                        class="flex h-9 w-9 flex-shrink-0 items-center justify-center
                                            rounded-xl bg-orange-50 text-orange-600">
                                        ✓
                                    </span>

                                    <span class="text-sm font-medium text-gray-700">
                                        Continúa desde donde lo dejaste
                                    </span>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span
                                        class="flex h-9 w-9 flex-shrink-0 items-center justify-center
                                            rounded-xl bg-orange-50 text-orange-600">
                                        ✓
                                    </span>

                                    <span class="text-sm font-medium text-gray-700">
                                        Aprende a tu propio ritmo
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                        PANEL DERECHO — ACCESO
                    ============================================== --}}
                    <div class="flex items-center
                                rounded-3xl
                                border border-gray-200
                                bg-white
                                p-8 sm:p-10 lg:p-14
                                shadow-sm">

                        <div class="w-full">

                            {{-- Encabezado --}}
                            <div class="mb-7">

                                <p class="mb-2 text-sm font-semibold text-orange-600">
                                    Bienvenido
                                </p>

                                <h2 class="text-2xl font-bold text-gray-900">
                                    Iniciar sesión
                                </h2>

                                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                                    Ingresa tus datos para acceder a tu espacio personal.
                                </p>

                            </div>

                            {{-- Contenido de login.blade.php --}}
                            {{ $slot }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>