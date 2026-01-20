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
            --brand-hover: #d9791f;
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

        /* =========================
            Header alumno
            ========================= */

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
            transition: color 0.15s ease;
        }

        header a:hover {
            color: var(--brand);
        }


        /* =========================
            Layout
            ========================= */

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }


        /* =========================
            Cursos
            ========================= */

        .courses-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;            
            border: 1px solid #f2d4b8;
            display: flex;
            flex-direction: column;
            transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0,0,0,0.08);
            border-color: rgba(244, 139, 37, 0.45);
        }

        .card h3 {
            margin-top: 0;
        }


        /* =========================
            Botones
            ========================= */

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
            transition: background 0.15s ease, transform 0.15s ease;
        }

        .btn:hover {
            background: var(--brand-hover);
            transform: translateY(-1px);
        }

        /* =========================
        Estado vacío
        ========================= */

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

        <div class="mb-10">
            <h1 class="brand-title">
                Mis Cursos
            </h1>
            <p class="brand-subtitle mt-1">
                Accede a tus cursos activos y continúa tu aprendizaje
            </p>
        </div>
              


        @if($courses->count() === 0)
            <p class="empty">No tienes cursos todavía. ¡Explora el catálogo!</p>
        @else
            <div class="courses-grid">
                @foreach($courses as $course)
                <div class="card">

                    {{-- Badge --}}                    
                    <span style="
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        margin-bottom: 14px;
                        padding: 6px 12px;
                        font-size: 12px;
                        font-weight: 700;
                        color: #15803d;
                        background: #dcfce7;
                        border-radius: 999px;
                    ">
                        ✔ Curso activo
                    </span>

                    <h3>{{ $course->title }}</h3>
                    <p style="color: var(--muted); font-size: 14px;">
                        {{ $course->description }}
                    </p>

                    <a href="{{ route('curso.detalle', $course->slug) }}" class="text-orange-600 font-semibold hover:underline">
                        Continuar Curso →
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <a href="{{ route('home') }}"
        style="
            position: fixed;
            bottom: 24px;
            right: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 20px;
            background: var(--brand);
            color: #fff;
            font-weight: 700;
            border-radius: 999px;
            text-decoration: none;
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
            z-index: 999;
        "
        onmouseover="this.style.background='#d9791f'"
        onmouseout="this.style.background='var(--brand)'">
            🔍 Explorar cursos
    </a>

</body>
</html>
