<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Aprobación</title>

    <style>
        /* 1️⃣ Página completa SIN márgenes */
        @page {
            size: A4 portrait;
            margin: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
        }

        /* 2️⃣ Marco del certificado */
        .marco {
            position: fixed;
            top: 20mm;
            left: 20mm;
            right: 20mm;
            bottom: 20mm;
            border: 6px solid #f97316;
        }

        /* 3️⃣ Contenido */
        .contenido {
            position: relative;
            padding: 35mm 30mm;
            text-align: center;
        }

        .logo img {
            max-width: 180px;
        }

        h1 {
            margin: 30px 0;
            font-size: 32px;
        }

        .nombre {
            font-size: 26px;
            font-weight: bold;
            margin: 20px 0;
        }

        .curso {
            color: #f97316;
            font-weight: bold;
            font-style: italic;
            margin: 15px 0;
        }

        .firma {
            margin-top: 60px;
        }

        .footer {
            margin-top: 35px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

<!-- MARCO -->
    <div class="marco">

        <!-- CONTENIDO -->
        <div class="contenido">

            <div class="logo">
                <img src="{{ public_path('images/logo-erika.png') }}">
            </div>

            <h1>CERTIFICADO DE APROBACIÓN</h1>

            <p>Se certifica que</p>

            <div class="nombre">{{ $user->name }}</div>

            <p>ha completado satisfactoriamente el curso</p>

            <div class="curso">“{{ $course->title }}”</div>

            <p>
                impartido por <strong>Erika Herrera</strong>, cumpliendo con todos los contenidos
                y actividades establecidos para su aprobación.
            </p>

            <p style="margin-top:20px;">
                Este certificado se otorga como reconocimiento a su compromiso, dedicación y
                participación activa en el proceso formativo.
            </p>

            <p style="margin-top:30px;">
                <strong>Fecha de finalización:</strong> {{ now()->format('d/m/Y') }}
            </p>

            <div class="firma">
                <div style="width:260px;border-top:1px solid #000;margin:0 auto 10px;"></div>
                <strong>Erika Herrera</strong><br>
                Instructora y Coach<br>
                Academia Erika Herrera
            </div>

            <div class="footer">
                Este certificado fue emitido por Academia Erika Herrera
            </div>

        </div>
    </div>

</body>
</html>
