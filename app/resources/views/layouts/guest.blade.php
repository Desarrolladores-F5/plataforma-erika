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
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-start sm:justify-center bg-gray-50 px-4 py-8">

        <!-- Branding simple (temporal) -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-semibold leading-tight">
                Plataforma Educativa
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Acceso a tu espacio de aprendizaje
            </p>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-{{ $maxWidth }} px-6 py-6 bg-white border border-gray-200 rounded-lg mb-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
