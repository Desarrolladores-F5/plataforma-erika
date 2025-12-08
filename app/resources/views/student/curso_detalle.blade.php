<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Curso · Aprendizaje y Desarrollo Personal</title>

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
      --shadow: 0 10px 30px rgba(0,0,0,.08);
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
    .btn-outline{
      background:transparent;
      border:2px solid var(--brand);
      color:var(--text);
    }
    .btn-ghost{
      background:transparent;
      border:0;
      color:#444;
      font-weight:700;
      padding:10px 0;
    }
    .chip{
      display:inline-block;
      padding:6px 10px;
      border-radius:999px;
      background:var(--brand-2);
      margin-right:8px;
      font-size:13px;
    }
    .card{
      background:var(--card);
      border-radius:var(--radius);
      padding:22px;
      border:1px solid var(--line);
      box-shadow:var(--shadow);
    }

    header{
      position:sticky;
      top:0;
      z-index:20;
      backdrop-filter:saturate(140%) blur(8px);
      background:rgba(255,249,243,.9);
      border-bottom:1px solid var(--line);
    }
    nav{height:64px;display:flex;align-items:center;justify-content:space-between;}
    nav .left{display:flex;gap:12px;align-items:center}
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

    .hero{padding:26px 0}
    .grid{display:grid;gap:28px;grid-template-columns: 1.05fr .95fr;align-items:start}
    .hero-img{
      border-radius:var(--radius);
      overflow:hidden;
      border:1px solid var(--line);
      box-shadow:var(--shadow);
    }
    .price{font-size:28px;font-weight:800}
    .muted{color:var(--muted)}
    .incluye{display:flex;gap:10px;flex-wrap:wrap;margin:10px 0}
    .incluye .chip{
      background:#eafaf2;
      color:#0c5132;
      border:1px solid #c6f6d5;
    }
    .block{margin:24px 0}
    details{
      border:1px solid var(--line);
      border-radius:14px;
      padding:12px 16px;
      background:#fff;
    }
    details+details{margin-top:10px}
    summary{cursor:pointer;font-weight:700}
    .stars{color:#f59e0b}

    footer{
      margin-top:32px;
      border-top:1px solid var(--line);
      background:linear-gradient(90deg,var(--brand-3),#ffe9d8);
    }
    .footer-grid{
      display:grid;
      gap:24px;
      grid-template-columns:repeat(3,1fr);
      padding:28px 0;
    }
    .copy{font-size:13px;color:#6b7280;padding-bottom:18px}

    @media (max-width: 900px){
      /* Header sin sticky para que no moleste al scrollear */
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

      /* Hero: imagen y texto en una columna */
      .grid{
        grid-template-columns: 1fr;
      }

      .hero{
        padding: 18px 0;
      }

      .hero-img{
        order: -1;
        margin-bottom: 12px;
      }

      /* Cards de opiniones y bloques en una columna */
      .container.block .card {
        grid-template-columns: 1fr;
      }

      .container.block .card img{
        max-width: 260px;
        margin: 0 auto;
      }

      section.container.block > div.card{
        grid-template-columns: 1fr;
      }

      .container.block + .container.block .card{
        grid-template-columns: 1fr;
      }

      .container.block + .container.block .card + .card{
        grid-template-columns: 1fr;
      }

      .container.block + .container.block{
        margin-top: 18px;
      }

      .container.block:last-of-type .card{
        grid-template-columns: 1fr;
      }

      .container.block:last-of-type .card img{
        margin-bottom: 10px;
      }

      .container.block:last-of-type .card > div{
        text-align: left;
      }

      .container.block .card .chip{
        margin-bottom: 4px;
      }

      .container.block .card .muted{
        font-size: 14px;
      }

      .container.block .card .stars{
        margin-bottom: 6px;
      }

      .footer-grid{
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <nav>
        <div class="left">
          <img src="https://erikaherrera.cl/imagenes/logo2.svg"
               alt="Erika Herrera"
               style="height:42px;width:auto;">
          <div class="brand" style="font-weight:700">Erika Herrera · Academia</div>
        </div>

        <ul>
          <li><a href="{{ url('/') }}#conoceme">Conóceme</a></li>
          <li><a href="{{ url('/') }}#cursos">Cursos</a></li>
          <li><a class="login" href="{{ route('login') }}">Tu Espacio (login)</a></li>
          <li><a class="register" href="{{ route('register') }}">Crear cuenta</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="container grid">
      <div class="hero-img">
        <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80" alt="Curso">
      </div>
      <div>
        <span class="chip">Curso asincrónico</span>
        <h1 style="font-family:'Playfair Display',serif;font-size: clamp(28px, 4vw, 42px);margin:8px 0 10px">
          Aprendizaje y Desarrollo Personal
        </h1>
        <p class="muted">
          Un programa práctico para fortalecer tu autoconocimiento, gestionar conversaciones y
          coordinar acciones con claridad.
        </p>

        <div class="incluye">
          <span class="chip">3 módulos</span>
          <span class="chip">Contenido en video</span>
          <span class="chip">Certificado</span>
          <span class="chip">Acceso 6 meses</span>
          <span class="chip">100% online</span>
        </div>

        <div style="display:flex;align-items:center;gap:12px;margin:16px 0">
          <div class="price">CLP 79.990</div>
          <div class="muted" style="font-size:12px">*precio referencial para demo</div>
        </div>

        <div style="display:flex;gap:12px;flex-wrap:wrap">
          <a class="btn" href="{{ route('checkout.iniciar', $course->slug) }}">
            Acceder / Comprar
          </a>
          <a class="btn btn-outline" href="#temario">Ver temario</a>
          <button class="btn-ghost" onclick="alert('Demo: aquí iría el carrito en la versión final');">
            Añadir al carrito
          </button>
        </div>

        <div class="block card" style="margin-top:18px">
          <strong>Lo que te llevarás</strong>
          <ul class="muted" style="margin:8px 0 0;padding-left:18px;list-style:disc">
            <li>Herramientas de neurocomunicación para la vida personal y profesional.</li>
            <li>Prácticas guiadas y recursos descargables (PDF).</li>
            <li>Estrategias para conversaciones difíciles y hábitos sostenibles.</li>
          </ul>
        </div>

        <button class="btn-ghost" onclick="window.location.href='{{ url('/') }}'">
          ← Volver al inicio
        </button>
      </div>
    </div>
  </section>

  <section id="temario" class="container">
    <h2 style="font-size:24px;margin-bottom:10px">Temario del curso</h2>

    <details open>
      <summary>Módulo 1 · Introducción al cambio (4 lecciones)</summary>
      <ul class="muted" style="margin:8px 0 0;padding-left:18px;list-style:disc">
        <li>Bienvenida y objetivos</li>
        <li>Mindset de aprendizaje</li>
        <li>Mapa vs. territorio</li>
        <li>Plan personal</li>
      </ul>
    </details>

    <details>
      <summary>Módulo 2 · Neurocomunicación aplicada (5 lecciones)</summary>
      <ul class="muted" style="margin:8px 0 0;padding-left:18px;list-style:disc">
        <li>Lenguaje y emoción</li>
        <li>Escucha activa</li>
        <li>Asertividad</li>
        <li>Feedback efectivo</li>
        <li>Prácticas</li>
      </ul>
    </details>

    <details>
      <summary>Módulo 3 · Herramientas y hábitos (4 lecciones)</summary>
      <ul class="muted" style="margin:8px 0 0;padding-left:18px;list-style:disc">
        <li>Gestión de hábitos</li>
        <li>Acción y coordinación</li>
        <li>Conversaciones difíciles</li>
        <li>Plan 30 días</li>
      </ul>
    </details>
  </section>

  <section class="container block">
    <div class="card" style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:center">
      <img src="https://placehold.co/500x500" alt="Erika" style="border-radius:14px">
      <div>
        <h3 style="margin:0 0 6px">Tu instructora: Erika Herrera</h3>
        <p class="muted">
          Coach y Trainer en PNL, especializada en Neurocomunicación.
          Más de 25 años acompañando a personas y equipos en procesos de cambio.
        </p>
        <div style="margin-top:10px">
          <span class="chip">PNL</span>
          <span class="chip">Liderazgo</span>
          <span class="chip">Equipos</span>
        </div>
      </div>
    </div>
  </section>

  <section class="container block">
    <h3 style="font-size:20px;margin-bottom:8px">Opiniones</h3>
    <div style="display:grid;gap:16px;grid-template-columns:repeat(3,1fr)">
      <div class="card">
        <div class="stars">★★★★★</div>
        <div class="muted">“Me ayudó a conversar mejor con mi equipo.”</div>
      </div>
      <div class="card">
        <div class="stars">★★★★★</div>
        <div class="muted">“Contenido claro y práctico, lo apliqué de inmediato.”</div>
      </div>
      <div class="card">
        <div class="stars">★★★★☆</div>
        <div class="muted">“Buen ritmo y muy humana la guía.”</div>
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
