<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>

<body style="margin:0; padding:0; background:#f9fafb; font-family: Arial, sans-serif;">
    <div style="width:100%; padding:30px 12px; background:#f9fafb;">

        <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

            {{-- Header --}}
            <div style="padding:22px; text-align:center; background:#fff;">
                <img src="{{ asset('images/logo-erika.png') }}" alt="Academia Erika Herrera"
                     style="max-width:160px; height:auto; display:inline-block;">
            </div>

            {{-- Body --}}
            <div style="padding:26px 26px 10px 26px; color:#111827;">

                <h2 style="margin:0 0 14px 0; font-size:22px;">
                    Hola {{ $user->name }} 👋
                </h2>

                <p style="margin:0 0 12px 0; font-size:15px; line-height:1.7; color:#374151;">
                    Te damos la bienvenida a <strong>Academia Erika Herrera</strong>.
                </p>

                <p style="margin:0 0 12px 0; font-size:15px; line-height:1.7; color:#374151;">
                    Tu cuenta ha sido creada exitosamente y ya puedes acceder a tus cursos,
                    materiales y certificaciones.
                </p>

                <div style="text-align:center; margin:22px 0 18px 0;">
                    <a href="{{ url('/') }}"
                       style="display:inline-block; background:#f97316; color:#ffffff; text-decoration:none;
                              padding:12px 22px; border-radius:10px; font-weight:700; font-size:15px;">
                        Ir a la plataforma
                    </a>
                </div>

                <p style="margin:0 0 12px 0; font-size:15px; line-height:1.7; color:#374151;">
                    Gracias por confiar en este espacio de aprendizaje y crecimiento 🌱
                </p>

                <p style="margin:18px 0 0 0; font-size:15px; line-height:1.7; color:#111827;">
                    Un abrazo,<br>
                    <strong>Erika Herrera</strong><br>
                    Coach y Trainer en Programación Neurolingüística
                </p>
            </div>

            {{-- Footer --}}
            <div style="padding:16px 26px; background:#fff7ed; border-top:1px solid #fde68a;">
                <p style="margin:0; font-size:12px; color:#6b7280; line-height:1.5;">
                    Si no solicitaste esta cuenta, puedes ignorar este correo.
                </p>
            </div>

        </div>

        <div style="max-width:600px; margin:12px auto 0 auto; text-align:center;">
            <p style="margin:0; font-size:12px; color:#9ca3af;">
                © {{ date('Y') }} Academia Erika Herrera
            </p>
        </div>

    </div>
</body>
</html>