<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo</title>

    <style>
        body {
            background: #FFF7EF;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        .card {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
            border: 1px solid #f2d4b8;
        }

        h1 {
            color: #F48B25;
            margin-bottom: 10px;
        }

        ul {
            margin-top: 20px;
        }

        li {
            margin-top: 8px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #F48B25;
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="card">
        <h1>Panel Administrativo</h1>

        <p>Bienvenida, <strong>{{ auth()->user()->name }}</strong>.</p>

        <p>Desde aquí podrás gestionar la plataforma:</p>

        <ul>
            <li>Ver alumnos inscritos</li>
            <li>Crear / editar cursos</li>
            <li>Subir módulos y materiales</li>
            <li>Revisar pagos y acceso</li>
        </ul>

        <a href="{{ url('/') }}">← Volver al inicio</a>
        
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 10px;">
            @csrf
            <button type="submit" style="
                background:#F48B25;
                color:white;
                border:none;
                padding:8px 16px;
                border-radius:999px;
                font-weight:600;
                cursor:pointer;
            ">
                Cerrar sesión
            </button>
        </form>
    </div>

</body>
</html>
