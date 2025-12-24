<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin | Plataforma Erika</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Vite / Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r p-4">
        <h2 class="text-xl font-bold mb-6">Panel Admin</h2>

        <nav class="space-y-2 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-2 py-1 rounded hover:bg-gray-100">
                Dashboard
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="block px-2 py-1 rounded hover:bg-gray-100">
                Cursos
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block px-2 py-1 rounded hover:bg-gray-100">
                Órdenes
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="block px-2 py-1 rounded hover:bg-gray-100">
                Alumnos
            </a>

            <hr class="my-4">

            <a href="{{ route('mi.espacio') }}"
               class="block px-2 py-1 rounded hover:bg-gray-100 text-gray-600">
                Ir a Mi Espacio
            </a>
        </nav>
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>
