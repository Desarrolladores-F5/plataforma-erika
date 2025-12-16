<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Cursos</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand: #F48B25;     /* Naranjo oficial */
            --bg: #FFF7EF;
            --text: #222222;
            --muted: #666666;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--bg);
            font-family: 'Quicksand', sans-serif;
            color: var(--text);
        }

        header {
            background: #fff;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        header h2 {
            margin: 0;
            font-weight: 700;
            color: var(--brand);
        }

        header a {
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            margin-left: 18px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .courses-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid #f2d4b8;
            display: flex;
            flex-direction: column;
        }

        .card h3 {
            margin-top: 0;
        }

        .btn {
            display: block;
            margin-top: auto;
            padding: 10px 14px;
            text-align: center;
            background: var(--brand);
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #d9791f;
        }

        .empty {
            text-align: center;
            margin-top: 60px;
            color: var(--muted);
            font-size: 18px;
        }
    </style>
</head>

<body>

    <!-- Header del alumno -->
    <header>
        <h2>Mi Espacio</h2>

        <div>
            <span>{{ auth()->user()->name }}</span>
            <a href="{{ route('profile.edit') }}">Perfil</a>
            <a href="{{ route('orders.index') }}"class="inline-block mt-4 text-indigo-600 hover:underline">📄 Ver historial de compras</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Cerrar sesión
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </header>

    <div class="container">
        <h1>Mis Cursos</h1>

        @if($courses->count() === 0)
            <p class="empty">No tienes cursos todavía. ¡Explora el catálogo!</p>
        @else
            <div class="courses-grid">
                @foreach($courses as $course)
                <div class="card">
                    <h3>{{ $course->title }}</h3>
                    <p style="color: var(--muted); font-size: 14px;">
                        {{ $course->description }}
                    </p>

                    <a href="{{ route('curso.detalle', $course->slug) }}" class="btn-primario">
                        Ver Curso →
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
