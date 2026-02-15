<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Academia Erika Herrera · Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#FFF7EF;
      --text:#222222;
      --muted:#555555;

      --brand:#F48B25;     /* naranjo oficial */
      --brand-2:#FFB66E;   /* acento naranjo claro */
      --brand-3:#FFE7D1;   /* fondo suave cálido */

      --card:#ffffff;
      --shadow: 0 10px 30px rgba(0,0,0,0.08);
      --radius: 20px;
      --line:#f1ddc8;
    }

    *{box-sizing:border-box}
    html,body{margin:0}
    body{
      font-family:"Quicksand",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background:var(--bg);
      color:var(--text);
    }
    img{max-width:100%;display:block}
    a{color:inherit;text-decoration:none}

    .container{max-width:1180px;margin:0 auto;padding:0 20px}

    .btn{
      display:inline-block;
      background:var(--brand);
      color:#fff;
      padding:12px 20px;
      border-radius:14px;
      font-weight:700;
      box-shadow:var(--shadow);
      transition:.25s transform,.25s filter;
    }
    .btn:hover{filter:brightness(.95);transform:translateY(-1px)}
    .btn-outline{background:transparent;border:2px solid var(--brand);color:var(--text)}

    header{
      position:sticky;
      top:0;
      z-index:20;
      backdrop-filter:saturate(140%) blur(8px);
      background:rgba(255,249,243,.8);
      border-bottom:1px solid var(--line);
    }
    nav{height:64px;display:flex;align-items:center;justify-content:space-between;}
    nav .left{display:flex;gap:12px;align-items:center}
    nav .brand{font-weight:700}
    nav ul{display:flex;gap:14px;align-items:center;margin:0;padding:0;list-style:none}
    nav li a{padding:8px 12px;border-radius:999px;background:var(--brand-3);}
    nav li a:hover{background:var(--brand-2)}
    nav .login{
      padding:10px 14px;
      border-radius:12px;
      background:var(--brand);
      font-weight:700;
      color:#fff;
    }
    nav .register{
      padding:10px 14px;
      border-radius:12px;
      background:transparent;
      border:2px solid var(--brand);
      font-weight:700;
      color:var(--brand);
    }

    .hero{position:relative;display:grid;align-items:center;min-height:68vh}
    .hero-wrap{display:grid;grid-template-columns:1.15fr .85fr;gap:36px;align-items:center}
    .hero h1{
      font-family:"Playfair Display",serif;
      font-weight:700;
      font-size: clamp(32px, 4vw, 54px);
      line-height:1.08;
      margin:0 0 14px;
    }
    .hero p{color:var(--muted);font-size:18px;margin:0 0 20px}
    .hero .cta{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
    .hero-card{
      background:var(--card);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      overflow:hidden;
      border:1px solid var(--line);
    }
    .hero-img img{ height: 260px; max-height: 260px; width: 100%; object-fit: cover; border-radius: var(--radius);} 
    .hero-wrap > div:first-child {
      margin-top: -20px;
    }
    .eyebrow{
      display:inline-block;
      padding:6px 12px;
      border-radius:999px;
      background:var(--brand-3);
      color:#555;
      margin-bottom:12px;
    }

    .features{padding:48px 0}
    .grid-3{display:grid;gap:20px;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));}
    .card{
      background:var(--card);
      border-radius:var(--radius);
      padding:22px;
      border:1px solid var(--line);
      box-shadow:var(--shadow);
    }
    .card h3{margin:6px 0 8px;font-size:20px}
    .muted{color:var(--muted)}

    .curso{padding:16px 0 64px}
    .curso .wrap{display:grid;gap:28px;grid-template-columns: 1.1fr .9fr;align-items:center}
    .tag{display:inline-block;padding:6px 10px;border-radius:999px;background:var(--brand-2);margin-right:8px}

    footer{
      margin-top:32px;
      border-top:1px solid var(--line);
      background:linear-gradient(90deg,var(--brand-3),#ffe9d8);
    }
    .footer-grid{display:grid;gap:24px;grid-template-columns:repeat(3,1fr);padding:28px 0}
    .copy{font-size:13px;color:#6b7280;padding-bottom:18px}

    @media (max-width: 900px){
      /* Header más cómodo en móvil */
      header{
        position: static;
      }

      nav{
        height: auto;
        padding: 8px 0 10px;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }

      nav .left{
        width: 100%;
        justify-content: space-between;
      }

      nav ul{
        width: 100%;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 14px;
      }

      nav li a{
        padding: 6px 10px;
      }

      nav .login,
      nav .register{
        padding: 8px 12px;
        font-size: 14px;
      }

      /* Hero: una columna, texto más compacto */
      .hero{
        min-height: auto;
        padding: 24px 0;
      }

      .hero-wrap{
        grid-template-columns: 1fr;
        gap: 18px;
      }

      /* Imagen arriba en móvil (queda muy lindo) */
      .hero-card.hero-img{
        order: -1;
      }

      .hero h1{
        font-size: 28px;
      }

      .hero p{
        font-size: 16px;
      }

      .cta{
        flex-direction: column;
        align-items: stretch;
      }

      .cta .btn,
      .cta .btn-outline{
        width: 100%;
        text-align: center;
      }

      /* Tarjetas de beneficios + Sesión de Coaching en una sola columna */
      .features{
        padding: 32px 0;
      }

      .grid-3{
        grid-template-columns: 1fr;
      }

      /* Footer en una columna */
      .footer-grid{
        grid-template-columns: 1fr;
      }

    }
    .card img{
        height: 210px;           /* misma altura para todas */
        width: 100%;
        object-fit: cover;
        border-radius: 14px;
    }

    .hero-card--curso{
      height: 280px;          /* ajusta: 220 / 260 / 280 / 320 */
      overflow: hidden;
      border-radius: 18px;    /* para que quede pro */
    }

    .hero-img--curso{
      width: 100%;
      height: 100%;
      object-fit: cover;      /* recorte elegante */
      display: block;
    }

    .hero-card--perfil {
    max-width: 320px;
    border-radius: 20px;
    overflow: hidden;
    }

    .hero-img--perfil {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .card-img {
    width: 100%;
    height: 180px;
    overflow: hidden;
    border-radius: 14px;
    margin-bottom: 12px;
    }

    .card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .courses-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 360px));
    gap:22px;
    justify-content:center;  /* centra cuando hay 1 o pocas cards */
    align-items:stretch;
    }

    .course-thumb{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:12px;
    display:block;
    margin-bottom:12px;
    }

    .card.placeholder{
    text-align:left;
    padding:24px;
    position:relative;
    }

    .badge{
    display:inline-block;
    margin-top:12px;
    padding:6px 10px;
    border-radius:999px;
    font-size:12px;
    background:#FFE8D6;
    color:#9A4A00;
    font-weight:600;
    }

    .nav-actions{
      list-style:none;
      display:flex;
      align-items:center;
      gap:12px;
      margin:0;
      padding:0;
    }

    .nav-btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;

      padding:10px 16px;
      border-radius:999px;

      font-weight:600;
      text-decoration:none;

      /* dejamos colores fijos (no cambian en hover) */
      background:#fff;
      color:#111;

      border:1px solid rgba(0,0,0,.12);

      /* animación */
      transform: translateZ(0);
      transition: transform .18s ease, box-shadow .18s ease;
      will-change: transform;
    }

    .nav-btn:hover{
      transform: scale(1.05);
      box-shadow: 0 10px 18px rgba(0,0,0,.08);
    }

    .nav-btn:active{
      transform: scale(1.02);
    }

    /* Botón principal (Tu Espacio) */
    .nav-btn.is-primary{
      background: var(--brand);
      color:#fff;
      border-color: transparent;
    }

  </style>
</head>
<body>
  <header>
    <div class="container">
      <nav>
        <div class="left">
          {{-- Logo en base64 tal como en tu maqueta --}}
          <img src="https://erikaherrera.cl/imagenes/logo2.svg" alt="Erika Herrera" style="height:58px;width:auto;">
        </div>
        <ul class="nav-actions">
          <li><a class="nav-btn" href="#conoceme">Conóceme</a></li>
          <li><a class="nav-btn is-primary" href="{{ route('mi.espacio') }}">Tu Espacio</a></li>
          <li><a class="nav-btn" href="{{ route('register') }}">Crear cuenta</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="container hero-wrap">
      <div>
        <span class="eyebrow">Bienestar · Autoconocimiento · Comunicación</span>
        <h1>Desarrolla tu comunicación y lidera con conciencia</h1>
        <p>Entrenamientos y cursos para potenciar el desarrollo personal y profesional,
           con enfoque en comunicación efectiva, liderazgo y Programación Neurolingüística.</p>
        <div class="cta">
          <a class="btn" href="#cursos">Explorar cursos</a>
          <a class="btn btn-outline" href="#ver-mas">Ver más</a>
        </div>
      </div>
      <div class="hero-card hero-img">
        <img src="{{ asset('images/portada.jpeg') }}" alt="Portada Erika Herrera">
      </div>
    </div>
  </section>

  <section class="features">
    <div class="container grid-3">
      <div class="card">
        <h3>100% online y a tu ritmo</h3>           <!-- 100% Online -->
        <p class="muted">Acceso asincrónico a módulos en video, guías y ejercicios prácticos.</p>
      </div>
      <div class="card">
        <h3>Comunicación efectiva</h3>             <!-- Comunicación efectiva -->
        <p class="muted">Asertividad, escucha activa, retroalimentación y empatía comunicacional.</p>
      </div>
      <div class="card">
        <h3>Certificado de finalización</h3>           <!-- Certificado -->
        <p class="muted">Recibe tu certificado al completar todos los módulos del curso.</p>
      </div>
      <div class="card">
        <h3>Sesión de Coaching</h3>               <!-- Coaching persolanizado -->
        <p class="muted">Al finalizar podrás acceder a una sesión personalizada 1 a 1 con Erika.</p>
      </div> 
    </div>
  </section>

  <section id="ver-mas" class="curso">
    <div class="container wrap">
      <div class="hero-card hero-card--curso">
        <img class="hero-img--curso"
             src="{{ asset('images/curso_destacado.jpeg') }}" alt="Curso destacado">             
      </div>

      <div>
        <span class="tag">Curso destacado</span>
        <h2 style="margin:8px 0 10px">Aprendizaje y Desarrollo Personal</h2>
        <p class="muted">
          Un programa práctico para fortalecer tu autoconocimiento, gestionar conversaciones y
          coordinar acciones con claridad.
        </p>                
        <p class="muted">
          Este es un ejemplo de cómo se verá un curso destacado en la plataforma. Más adelante
          reemplazaremos este contenido por los cursos reales que defina Erika.
        </p>

        <!-- Botones grandes al estilo maqueta -->
        <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
          <a class="btn" href="{{ route('courses.show', 'autoconocimiento-bienestar-demo') }}">
            Acceder / Comprar
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="conoceme" class="features" style="padding-top:0">
    <div class="container card" style="display:grid;grid-template-columns: 1fr 1.4fr;gap:22px;align-items:center">
      <div class="hero-card hero-card--perfil">
          <img class="hero-img--perfil"
              src="{{ asset('images/placeholder_erika.png') }}"
              alt="Foto de Erika Herrera">
      </div>
      <div>
        <h3 style="font-size:24px">Conóceme</h3>
        <p class="muted">
          Coach y Trainer en Programación Neurolingüística, especializada en Neurocomunicación.
          Más de 25 años trabajando con personas y facilitando procesos de cambio en organizaciones
          y equipos.
        </p>

        <p class="muted" style="margin-top:10px">
            Puedes conocer más en
          <a href="https://erikaherrera.cl" target="_blank" rel="noopener"
             style="color: var(--brand); font-weight:700; text-decoration: underline;">
              www.erikaherrera.cl
            </a>.
        </p>
        <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap">
          <span class="tag">PNL</span><span class="tag">Liderazgo</span><span class="tag">Equipos</span>
        </div>
      </div>
    </div>
  </section>

  <section class="cursos">
    <div class="container">

      <h2 style="margin-bottom:16px;">Cursos y entrenamientos</h2>

      <div class="courses-grid">
        @forelse($courses as $course)
          <div class="card">

            <img
              src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : asset('images/curso_default.jpg') }}"
              alt="{{ $course->title }}"
              class="course-thumb">

            <h3>{{ $course->title }}</h3>

            <p class="muted">
              {{ \Illuminate\Support\Str::limit($course->description ?? '', 80) }}
            </p>

            <a href="{{ route('curso.detalle', $course->slug) }}" class="btn">
              Ver más
            </a>

          </div>
        @empty

          {{-- Placeholder bonito si no hay cursos publicados --}}
          <div class="card placeholder">
            <h3>Pronto tendremos novedades ✨</h3>
            <p class="muted">
              Estamos preparando nuevos cursos y entrenamientos. ¡Atento/a a los próximos lanzamientos!
            </p>
            <span class="badge">Próximamente</span>
          </div>

        @endforelse
      </div>

    </div>
  </section>


  
  <footer>
  <div class="container footer-grid">

    <div>
      <div style="font-weight:700">Erika Herrera</div>
      <div>Trainer en Programación Neurolingüística</div>
    </div>

    <div>
      <div><strong>Hablemos</strong></div>

      <!-- Teléfono -->
      <div style="display:flex;align-items:center;gap:6px;margin-top:8px">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#F48B25" viewBox="0 0 24 24">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 
                   19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.1 
                   2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 
                   12.84 12.84 0 0 0 .7 2.81A2 2 0 0 1 9 8l-1.5 1.5a16 16 0 0 0 6 6L14 14a2 2 0 0 1 1.47-.79 
                   12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        +56 9 5408 2624
      </div>

      <!-- Email -->
      <div style="display:flex;align-items:center;gap:6px;margin-top:8px">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#F48B25" viewBox="0 0 24 24">
          <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 
                   8-5z"/>
        </svg>
        contacto@erikaherrera.cl
      </div>

      <!-- WhatsApp -->
      <div style="display:flex;align-items:center;gap:6px;margin-top:8px">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#25D366" width="18" height="18" viewBox="0 0 32 32">
          <path d="M16 3C9 3 3 9 3 16s6 13 13 13c2.3 0 4.4-.6 6.3-1.7l3.7 
                   1-1-3.6C26.4 22.3 27 20.2 27 18c0-7-6-13-13-13zm0 
                   23c-5.4 0-10-4.6-10-10S10.6 6 16 6s10 4.6 10 10-4.6 10-10 10zm5.1-7.4c-.3-.2-1.7-.9-2-1-.3-.1-.5-.2-.7.2-.2.3-.8 
                   1-.9 1.1-.2.2-.3.2-.6.1-.3-.2-1.1-.4-2-1.2-.7-.6-1.2-1.3-1.4-1.6-.1-.3 
                   0-.5.1-.6.1-.1.3-.3.4-.4.1-.1.2-.3.3-.4.1-.2.1-.4 0-.6s-.7-1.6-1-2.2c-.3-.7-.5-.6-.7-.6h-.6c-.2 
                   0-.6.1-.9.4-.3.3-1.2 1.1-1.2 2.7s1.2 3.1 1.4 3.3c.2.2 2.4 3.7 6 5 
                   3.6 1.3 3.6.9 4.3.9.7 0 2.2-.9 2.5-1.8.3-.9.3-1.6.2-1.8-.1-.2-.3-.3-.6-.4z"/>
        </svg>
        +56 9 5408 2624
      </div>

    </div>

    <!-- Redes -->
    <div>
      <div><strong>Redes</strong></div>

      <!-- Instagram -->
      <div style="display:flex;align-items:center;gap:6px;margin-top:8px">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#F48B25" viewBox="0 0 24 24">
          <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 
                   0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 
                   2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 
                   0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 
                   3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 
                   2a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm4.8-3.8a1.2 
                   1.2 0 1 0 0 2.4 1.2 1.2 0 0 0 0-2.4z"/>
        </svg>
        @erikaherrerasanhueza
      </div>

    </div>

  </div>

  <div class="container copy">
    © <span id="y"></span> UpF5. Todos los derechos reservados.
  </div>
  </footer>


  <script>
    document.getElementById('y').textContent = new Date().getFullYear();
  </script>
</body>
</html>
