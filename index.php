<?php
include('bd/conexion.php');

// Obtener los últimos 10 testimonios de la base de datos
$sentencia = $conexion->prepare("SELECT * FROM testimonios ORDER BY fecha DESC LIMIT 10");
$sentencia->execute();
$testimonios = $sentencia->fetchAll(PDO::FETCH_OBJ);

// Registro fotográfico (Lámina 05): toma las fotografías reales de img/trabajo/.
// Mientras esa carpeta no tenga fotos, usa la única fotografía del proyecto y
// muestra sus ampliaciones para que el carrusel sea funcional desde el inicio.
$galeria_dir = __DIR__ . '/img/trabajo';
$galeria = [];

if (is_dir($galeria_dir)) {
  $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
  foreach (scandir($galeria_dir) as $archivo) {
    if (!in_array(strtolower(pathinfo($archivo, PATHINFO_EXTENSION)), $permitidos, true)) {
      continue;
    }
    $medidas = getimagesize($galeria_dir . '/' . $archivo);
    $galeria[] = [
      'src'   => 'img/trabajo/' . $archivo,
      'alt'   => 'Fotografía de una sesión de terapia ocupacional',
      'label' => 'Sesión en curso',
      'zoom'  => 1,
      'ox'    => '50%',
      'oy'    => '50%',
      'w'     => $medidas ? $medidas[0] : null,
      'h'     => $medidas ? $medidas[1] : null,
    ];
  }
}

if (empty($galeria)) {
  $galeria = [
    ['src' => 'img/trabajo.jpg', 'label' => 'Sesión en curso',  'zoom' => 1,   'ox' => '50%', 'oy' => '50%', 'alt' => 'Registro fotográfico de una sesión de terapia ocupacional', 'w' => 474, 'h' => 314],
    ['src' => 'img/trabajo.jpg', 'label' => 'Detalle · 1,5×',   'zoom' => 1.5, 'ox' => '30%', 'oy' => '40%', 'alt' => 'Ampliación de la fotografía de la sesión', 'w' => 474, 'h' => 314],
    ['src' => 'img/trabajo.jpg', 'label' => 'Detalle · 2×',     'zoom' => 2,   'ox' => '68%', 'oy' => '60%', 'alt' => 'Ampliación de la fotografía de la sesión', 'w' => 474, 'h' => 314],
  ];
}

$galeria_total = count($galeria);
$galeria_fotos = count(array_unique(array_column($galeria, 'src')));

// Variables para valores ingresados y errores
$errores = [];
$nombre = '';
$mensaje = '';

// Validación y procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'], $_POST['mensaje'])) {
  $nombre = trim($_POST['nombre']);
  $mensaje = trim($_POST['mensaje']);

  // Validaciones
  if (empty($nombre)) {
    $errores['nombre'] = "El nombre es obligatorio."; // Validar que el nombre no esté vacío
  } elseif (!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u", $nombre)) { // Validar que el nombre solo contenga letras
    $errores['nombre'] = "El nombre solo debe contener letras.";
  } elseif (mb_strlen($nombre) > 100) { // Validar que el nombre no supere los 100 caracteres
    $errores['nombre'] = "El nombre no puede superar los 100 caracteres.";
  }

  if (empty($mensaje)) {
    $errores['mensaje'] = "El mensaje no puede estar vacío."; // Validar que el mensaje no esté vacío
  } elseif (mb_strlen($mensaje) > 600) {
    $errores['mensaje'] = "El mensaje no puede superar los 600 caracteres."; // Validar que el mensaje no supere los 600 caracteres
  }

  // Si no hay errores, guardar en la base de datos
  if (empty($errores)) {
    try {
      $stmt = $conexion->prepare("INSERT INTO testimonios (nombre, mensaje) VALUES (:nombre, :mensaje)");
      $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
      $stmt->execute();
      header("Location: index.php?enviado=1#lamina-06");
      exit;
    } catch (PDOException $e) {
      echo "Error al insertar testimonio: " . $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#eeeef0" />
  <meta name="description" content="Terapia ocupacional Vida Plena: acompañamiento personalizado para niños, adultos y personas mayores. Estimulación cognitiva, intervención infantil y rehabilitación física." />
  <title>Vida Plena — Terapia Ocupacional</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Martian+Mono:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
  <a class="skip-link" href="#lamina-01">Ir al contenido</a>

  <header class="site-head">
    <div class="site-head__inner">
      <a class="brand" href="#lamina-01">
        <img class="brand__logo" src="img/logo.jpg" alt="Logotipo de Vida Plena" width="42" height="42" />
        <span class="brand__text">
          <span class="brand__name">Vida Plena</span>
          <span class="brand__kind mono">Terapia Ocupacional</span>
        </span>
      </a>

      <nav class="plate-index" aria-label="Índice de láminas">
        <a href="#lamina-02"><span class="plate-index__no">02</span><span class="plate-index__label">Quién soy</span></a>
        <a href="#lamina-03"><span class="plate-index__no">03</span><span class="plate-index__label">Servicios</span></a>
        <a href="#lamina-04"><span class="plate-index__no">04</span><span class="plate-index__label">Recorrido</span></a>
        <a href="#lamina-05"><span class="plate-index__no">05</span><span class="plate-index__label">Trabajo</span></a>
        <a href="#lamina-06"><span class="plate-index__no">06</span><span class="plate-index__label">Testimonios</span></a>
        <a href="#lamina-07"><span class="plate-index__no">07</span><span class="plate-index__label">Contacto</span></a>
      </nav>

      <div class="site-head__cta">
        <a class="stamp" href="https://wa.me/593987384545?text=¡Hola!%20Quisiera%20más%20información%20sobre%20tus%20servicios%20de%20terapia%20ocupacional." target="_blank" rel="noopener" aria-label="Escríbeme por WhatsApp">
          <span class="stamp__dot" aria-hidden="true"></span>
          <span class="stamp__text">Escríbeme</span>
        </a>
      </div>
    </div>
  </header>

  <main id="contenido">

    <!-- Lámina 01 — portada -->
    <section class="atlas-cover" id="lamina-01" aria-labelledby="cover-title">
      <div class="atlas-cover__frame">
        <div class="measure-plate" aria-hidden="true">
          <svg viewBox="0 0 120 100" preserveAspectRatio="none">
            <defs>
              <pattern id="minor-grid" width="1.2" height="1.2" patternUnits="userSpaceOnUse">
                <path d="M1.2 0H0V1.2" fill="none" stroke="#14161b" stroke-opacity="0.06" stroke-width="0.04" />
              </pattern>
              <pattern id="major-grid" width="6" height="6" patternUnits="userSpaceOnUse">
                <rect width="6" height="6" fill="url(#minor-grid)" />
                <path d="M6 0H0V6" fill="none" stroke="#14161b" stroke-opacity="0.12" stroke-width="0.08" />
              </pattern>
            </defs>
            <rect width="120" height="100" fill="url(#major-grid)" />
          </svg>
        </div>
        <div class="measure-plate__ruler" aria-hidden="true"></div>

        <div class="cover-grid">
          <div class="cover">
            <h1 id="cover-title">Devolver el <em>movimiento</em> de la vida diaria</h1>
            <p class="cover__lede">
              Acompaño a personas de todas las edades a recuperar las actividades que sostienen su día:
              vestirse, cocinar, jugar, estudiar, caminar. Cada plan se diseña sobre las necesidades
              reales de quien lo vive, no sobre un protocolo genérico.
            </p>

            <div class="cover__actions">
              <a class="stamp" href="https://wa.me/593987384545?text=¡Hola!%20Quisiera%20más%20información%20sobre%20tus%20servicios%20de%20terapia%20ocupacional." target="_blank" rel="noopener">
                <span class="stamp__dot" aria-hidden="true"></span>
                Escríbeme por WhatsApp
              </a>
              <a class="stamp stamp--ghost" href="#lamina-03">Ver servicios</a>
              <span class="cover__note mono">Respuesta directa, sin intermediarios</span>
            </div>

            <dl class="cover__legend">
              <div>
                <dt>Edades</dt>
                <dd>Niños, adultos y personas mayores</dd>
              </div>
              <div>
                <dt>Enfoque</dt>
                <dd>Plan personalizado por objetivo</dd>
              </div>
              <div>
                <dt>Terapia</dt>
                <dd>Individual y en sesión</dd>
              </div>
            </dl>
          </div>

          <figure class="fig-scene" data-scene aria-label="Lámina anatómica: maniquí articulado de madera midiendo el rango de movimiento de un brazo">
            <span class="fig-ghost" aria-hidden="true">01</span>

            <div class="fig-arc" data-draw aria-hidden="true">
              <svg viewBox="0 0 400 400">
                <g stroke="none">
                  <path class="fig-arc__fan" d="M200 168 L340 168" />
                  <path class="fig-arc__fan" d="M200 168 L324 96" />
                  <path class="fig-arc__fan" d="M200 168 L272 46" />
                  <path class="fig-arc__fan" d="M200 168 L200 30" />
                </g>
                <circle cx="200" cy="168" r="140" fill="none" stroke="#14161b" stroke-opacity="0.12" stroke-width="1" stroke-dasharray="2 6" />
                <path class="fig-arc__range-under" d="M340 168 A140 140 0 0 0 200 28" />
                <path class="fig-arc__range" d="M340 168 A140 140 0 0 0 200 28" />
                <g class="fig-arc__tick">
                  <path d="M336 182 L336 194" />
                  <path d="M305 118 L316 124" />
                  <path d="M238 62 L244 52" />
                </g>
                <path d="M200 168 L340 168" stroke="#2440db" stroke-width="1" stroke-linecap="round" />
                <circle cx="200" cy="168" r="7" fill="#14161b" />
              </svg>
            </div>

            <div class="fig-figure" data-figure aria-hidden="true">
              <div class="fig-shadow"></div>
              <div class="fig">
                <div class="fig__part fig__head"></div>
                <div class="fig__part fig__neck"></div>
                <div class="fig__part fig__torso"></div>
                <div class="fig__part fig__pelvis"></div>

                <div class="fig__part fig__arm fig__arm--lu"></div>
                <div class="fig__part fig__arm fig__arm--ru"></div>
                <div class="fig__part fig__arm fig__arm--ll"></div>
                <div class="fig__part fig__arm fig__arm--rl"></div>

                <div class="fig__part fig__hand fig__hand--l"></div>
                <div class="fig__part fig__hand fig__hand--r"></div>

                <div class="fig__part fig__leg fig__leg--lu"></div>
                <div class="fig__part fig__leg fig__leg--ru"></div>
                <div class="fig__part fig__leg fig__leg--ll"></div>
                <div class="fig__part fig__leg fig__leg--rl"></div>

                <div class="fig__part fig__foot fig__foot--l"></div>
                <div class="fig__part fig__foot fig__foot--r"></div>

                <div class="fig__joint fig__joint--shoulder-l"></div>
                <div class="fig__joint fig__joint--shoulder-r"></div>
                <div class="fig__joint fig__joint--elbow-l"></div>
                <div class="fig__joint fig__joint--elbow-r"></div>
                <div class="fig__joint fig__joint--hip-l"></div>
                <div class="fig__joint fig__joint--hip-r"></div>
                <div class="fig__joint fig__joint--knee-l"></div>
                <div class="fig__joint fig__joint--knee-r"></div>
              </div>
            </div>

            <div class="fig-notes mono" aria-hidden="true">
              <span class="fig-note fig-note--arc">Arco de rango<i class="fig-note__tick"></i></span>
              <span class="fig-note fig-note--shoulder">Hombro<i class="fig-note__tick"></i></span>
              <span class="fig-note fig-note--stance">Base de apoyo<i class="fig-note__tick"></i></span>
            </div>

            <figcaption class="fig-caption">
              <span>Fig. 01 — Maniquí de medición</span>
              <span>Lámina 01 · esc. 1:1</span>
            </figcaption>
          </figure>
        </div>
      </div>
    </section>

    <!-- Lámina 02 — quién soy -->
    <section class="plate" id="lamina-02" aria-labelledby="quien-title">
      <div class="plate__caption reveal">
        <h2 id="quien-title">Quién soy</h2>
        <p class="plate__code"><b>Lámina 02</b>Retrato · recorte 4:3</p>
      </div>

      <div class="portrait">
        <figure class="specimen reveal">
          <span class="specimen__crop specimen__crop--tl" aria-hidden="true"></span>
          <span class="specimen__crop specimen__crop--tr" aria-hidden="true"></span>
          <span class="specimen__crop specimen__crop--bl" aria-hidden="true"></span>
          <span class="specimen__crop specimen__crop--br" aria-hidden="true"></span>
          <img src="img/yo.jpg" alt="Retrato de la terapeuta ocupacional de Vida Plena" width="640" height="640" loading="lazy" />
          <figcaption class="specimen__caption">
            <span>Fig. 02.a</span>
            <span>Retrato</span>
          </figcaption>
        </figure>

        <div class="reveal">
          <p class="plate__lead">
            Soy terapeuta ocupacional y trabajo, sesión a sesión, en las actividades concretas que
            cada persona necesita recuperar para vivir con autonomía.
          </p>
          <p style="margin-top:1rem; color: var(--ink-2);">
            Mi punto de partida es la vida cotidiana: qué le cuesta hoy a la persona, qué quiere
            volver a hacer y qué recursos tiene a mano. Desde ahí construyo un plan que combina
            juego, movimiento y ejercicio mental, y que avanza al ritmo de quien lo sigue. El
            objetivo no es solo entrenar una función, sino que esa función sirva en la casa, en la
            escuela o en el trabajo.
          </p>

          <dl class="trait-list">
            <div>
              <dt>Con quién</dt>
              <dd>Niños, adultos y personas mayores</dd>
            </div>
            <div>
              <dt>Cómo</dt>
              <dd>Sesiones individuales con objetivos medibles en la vida diaria</dd>
            </div>
            <div>
              <dt>Dónde</dt>
              <dd>En consulta y en el entorno real de la persona</dd>
            </div>
          </dl>
        </div>
      </div>
    </section>

    <!-- Lámina 03 — servicios -->
    <section class="plate" id="lamina-03" aria-labelledby="servicios-title">
      <div class="plate__caption reveal">
        <h2 id="servicios-title">Servicios</h2>
        <p class="plate__code"><b>Lámina 03</b>Procedimientos · 03.1–03.3</p>
      </div>

      <div class="procedures">
        <article class="procedure reveal" style="--i:0">
          <div class="procedure__diagram" aria-hidden="true">
            <svg viewBox="0 0 320 200">
              <g class="procedure__grid">
                <path class="procedure__grid-line" d="M80 20V180M160 20V180M240 20V180M20 70H300M20 130H300" />
              </g>
              <circle cx="160" cy="100" r="58" class="procedure__lines" />
              <circle cx="160" cy="100" r="34" class="procedure__lines" stroke-dasharray="3 5" />
              <circle cx="160" cy="100" r="11" class="procedure__dot" />
              <path class="procedure__lines" d="M126 66L160 100L214 58" />
              <circle cx="126" cy="66" r="4" fill="#14161b" />
              <circle cx="214" cy="58" r="4" fill="#14161b" />
              <path class="procedure__arc" d="M118 44 A58 58 0 0 1 202 44" />
            </svg>
          </div>
          <div class="procedure__body">
            <div class="procedure__head">
              <span class="procedure__no mono">03.1</span>
              <h3>Estimulación cognitiva</h3>
            </div>
            <p>
              Programas para mantener activas la memoria, la atención, la concentración y la
              planificación. Se trabajan con ejercicios y tareas cotidianas: organizar la semana,
              recordar una receta, manejar dinero, sostener una conversación. Pensado para personas
              mayores, adultos con deterioro cognitivo y para quien quiera conservar su agudeza
              mental.
            </p>
            <p class="procedure__meta mono">
              <span class="tag">Memoria</span>
              <span class="tag">Atención</span>
              <span class="tag">Planificación</span>
            </p>
          </div>
        </article>

        <article class="procedure reveal" style="--i:1">
          <div class="procedure__diagram" aria-hidden="true">
            <svg viewBox="0 0 320 200">
              <g>
                <path class="procedure__grid-line" d="M80 20V180M160 20V180M240 20V180M20 70H300M20 130H300" />
              </g>
              <circle cx="148" cy="96" r="13" class="procedure__lines" />
              <path class="procedure__lines" d="M148 109V150M148 122L126 138M148 122L172 110M148 150L136 180M148 150L162 180" />
              <circle class="procedure__dot" cx="196" cy="78" r="9" />
              <path class="procedure__arc" d="M176 92 A34 34 0 0 1 206 66" />
            </svg>
          </div>
          <div class="procedure__body">
            <div class="procedure__head">
              <span class="procedure__no mono">03.2</span>
              <h3>Intervención infantil</h3>
            </div>
            <p>
              A través del juego trabajo el desarrollo motor, sensorial, cognitivo y social de
              niños y niñas que encuentran dificultades en su crecimiento. El entorno es cercano y
              seguro, y las metas se traducen en cosas concretas: sostener el lápiz, vestirse solo,
              coordinar el cuerpo, jugar con otros.
            </p>
            <p class="procedure__meta mono">
              <span class="tag">Juego</span>
              <span class="tag">Motricidad</span>
              <span class="tag">Autonomía</span>
            </p>
          </div>
        </article>

        <article class="procedure reveal" style="--i:2">
          <div class="procedure__diagram" aria-hidden="true">
            <svg viewBox="0 0 320 200">
              <g>
                <path class="procedure__grid-line" d="M80 20V180M160 20V180M240 20V180M20 70H300M20 130H300" />
              </g>
              <circle cx="150" cy="60" r="12" class="procedure__lines" />
              <path class="procedure__lines" d="M150 72V118M150 84L124 104M150 84L176 100M150 118L132 148L138 180M150 118L168 146L164 180" />
              <path class="procedure__lines" d="M196 180V162" />
              <path class="procedure__lines" d="M188 160H204" />
              <path class="procedure__arc" d="M138 152 A26 26 0 0 0 168 150" />
              <circle class="procedure__dot" cx="168" cy="146" r="4" />
            </svg>
          </div>
          <div class="procedure__body">
            <div class="procedure__head">
              <span class="procedure__no mono">03.3</span>
              <h3>Rehabilitación física</h3>
            </div>
            <p>
              Acompañamiento en el proceso de recuperación después de una lesión, una cirugía o una
              enfermedad neurológica. El trabajo se centra en la movilidad, la coordinación y la
              fuerza aplicada a la vida diaria, para volver a las actividades con seguridad:
              levantarse, caminar, bañarse, cocinar.
            </p>
            <p class="procedure__meta mono">
              <span class="tag">Movilidad</span>
              <span class="tag">Coordinación</span>
              <span class="tag">Vida diaria</span>
            </p>
          </div>
        </article>
      </div>
    </section>

    <!-- Lámina 04 — recorrido -->
    <section class="plate" id="lamina-04" aria-labelledby="recorrido-title">
      <div class="plate__caption reveal">
        <h2 id="recorrido-title">Cómo trabajamos</h2>
        <p class="plate__code"><b>Lámina 04</b>Recorrido · 3 fases</p>
      </div>

      <div class="sequence">
        <div class="step reveal" style="--i:0">
          <span class="step__no">Fase 1</span>
          <h3>Valoración</h3>
          <p>
            Una primera conversación para entender qué necesita la persona, qué hace hoy sin
            dificultad y dónde está el obstáculo. De ahí sale el objetivo de trabajo.
          </p>
        </div>
        <div class="step reveal" style="--i:1">
          <span class="step__no">Fase 2</span>
          <h3>Plan personalizado</h3>
          <p>
            Actividades y ejercicios elegidos para ese objetivo concreto, con una progresión clara
            y ajustes según la respuesta de cada persona.
          </p>
        </div>
        <div class="step reveal" style="--i:2">
          <span class="step__no">Fase 3</span>
          <h3>Acompañamiento</h3>
          <p>
            Seguimiento del avance en la vida diaria, con la familia como parte del proceso cuando
            ayuda al objetivo.
          </p>
        </div>
      </div>
    </section>

    <!-- Lámina 05 — trabajo -->
    <section class="plate" id="lamina-05" aria-labelledby="trabajo-title">
      <div class="plate__caption reveal">
        <h2 id="trabajo-title">El trabajo</h2>
        <p class="plate__code"><b>Lámina 05</b>Registro · <?= $galeria_fotos ?> fotografía<?= $galeria_fotos === 1 ? '' : 's' ?></p>
      </div>

      <div class="contact-sheet">
        <div class="slider reveal" data-slider role="region" aria-roledescription="carrusel" aria-label="Registro fotográfico de las sesiones">
          <ul class="slider__track" data-track tabindex="0" aria-label="Fotografías. Usa las flechas izquierda y derecha para navegar.">
            <?php foreach ($galeria as $i => $foto): ?>
              <li class="slider__slide" role="group" aria-roledescription="diapositiva" aria-label="<?= ($i + 1) . ' de ' . $galeria_total ?>">
                <figure class="sheet-frame">
                  <div class="sheet-frame__media" style="--zoom: <?= htmlspecialchars($foto['zoom']) ?>; --ox: <?= htmlspecialchars($foto['ox']) ?>; --oy: <?= htmlspecialchars($foto['oy']) ?>">
                    <img src="<?= htmlspecialchars($foto['src']) ?>" alt="<?= htmlspecialchars($foto['alt']) ?>"<?= $foto['w'] ? ' width="' . (int) $foto['w'] . '" height="' . (int) $foto['h'] . '"' : '' ?> loading="lazy" />
                  </div>
                  <figcaption class="sheet-frame__meta">
                    <span>Fig. 05.<?= chr(97 + $i) ?> — <?= htmlspecialchars($foto['label']) ?></span>
                    <span class="mono"><?= ($i + 1) . ' / ' . $galeria_total ?></span>
                  </figcaption>
                </figure>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="slider__controls">
            <button type="button" class="slider__btn" data-slider-prev aria-label="Fotografía anterior">
              <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M7.5 2.5 4 6l3.5 3.5" /></svg>
            </button>
            <ol class="slider__dots" data-slider-dots>
              <?php foreach ($galeria as $i => $foto): ?>
                <li>
                  <button type="button" class="slider__dot<?= $i === 0 ? ' is-active' : '' ?>" data-slider-dot="<?= $i ?>" aria-label="Ir a la fotografía <?= ($i + 1) . ' de ' . $galeria_total ?>"<?= $i === 0 ? ' aria-current="true"' : '' ?>></button>
                </li>
              <?php endforeach; ?>
            </ol>
            <button type="button" class="slider__btn" data-slider-next aria-label="Fotografía siguiente">
              <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M4.5 2.5 8 6l-3.5 3.5" /></svg>
            </button>
          </div>
        </div>

        <aside class="sheet-aside reveal">
          <p>
            Este espacio reúne el registro real de las sesiones: material de trabajo, ejercicios y
            avances. Se actualiza cuando hay fotografías nuevas disponibles. Hoy hay
            <?= $galeria_fotos ?> fotografía<?= $galeria_fotos === 1 ? '' : 's' ?>; las vistas adicionales
            amplían esa misma toma.
          </p>
          <ul class="sheet-aside__list">
            <li><span>Fotografías disponibles</span><span><?= $galeria_fotos ?></span></li>
            <li><span>Formato de registro</span><span>JPG</span></li>
            <li><span>Carpeta</span><span>img/</span></li>
          </ul>
        </aside>
      </div>
    </section>

    <!-- Lámina 06 — testimonios -->
    <section class="plate" id="lamina-06" aria-labelledby="testimonios-title">
      <div class="plate__caption reveal">
        <h2 id="testimonios-title">Testimonios</h2>
        <p class="plate__code"><b>Lámina 06</b>Registros · <?= count($testimonios) ?></p>
      </div>

      <div class="records">
        <?php if (empty($testimonios)): ?>
          <ul class="record-list reveal">
            <li class="record-empty">Aún no hay testimonios registrados. El primero puede ser el tuyo.</li>
          </ul>
        <?php else: ?>
          <div class="slider slider--records reveal" data-slider role="region" aria-roledescription="carrusel" aria-label="Testimonios de clientes">
            <ul class="slider__track" data-track tabindex="0" aria-label="Testimonios. Usa las flechas izquierda y derecha para navegar.">
              <?php foreach ($testimonios as $i => $index): ?>
                <li class="slider__slide" role="group" aria-roledescription="diapositiva" aria-label="<?= ($i + 1) . ' de ' . count($testimonios) ?>">
                  <figure class="record">
                    <span class="record__rule" aria-hidden="true"></span>
                    <figcaption class="record__head">
                      <span class="record__who"><?= htmlspecialchars($index->nombre) ?></span>
                      <span class="record__date"><?= date('d/m/Y', strtotime($index->fecha)) ?></span>
                    </figcaption>
                    <blockquote class="record__quote">“<?= htmlspecialchars($index->mensaje) ?>”</blockquote>
                  </figure>
                </li>
              <?php endforeach; ?>
            </ul>

            <div class="slider__controls">
              <button type="button" class="slider__btn" data-slider-prev aria-label="Testimonio anterior">
                <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M7.5 2.5 4 6l3.5 3.5" /></svg>
              </button>
              <span class="slider__counter" data-slider-counter aria-hidden="true">01 / <?= count($testimonios) ?></span>
              <button type="button" class="slider__btn" data-slider-next aria-label="Testimonio siguiente">
                <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M4.5 2.5 8 6l-3.5 3.5" /></svg>
              </button>
            </div>
          </div>
        <?php endif; ?>

        <div class="entry reveal">
          <div class="entry__title">
            <h3>Envía tu testimonio</h3>
            <span>Ficha 06.a</span>
          </div>

          <form id="formTestimonio" action="index.php#lamina-06" method="POST" novalidate>
            <div class="field<?= !empty($errores['nombre']) ? ' is-invalid' : '' ?>" data-field="nombre">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?= htmlspecialchars($nombre) ?>" required maxlength="100" autocomplete="name" aria-describedby="error-nombre" />
              <span class="field__error" id="error-nombre" role="alert"><?= $errores['nombre'] ?? '' ?></span>
            </div>

            <div class="field<?= !empty($errores['mensaje']) ? ' is-invalid' : '' ?>" data-field="mensaje">
              <label for="mensaje">Experiencia</label>
              <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu experiencia..." required maxlength="600" aria-describedby="error-mensaje hint-mensaje"><?= htmlspecialchars($mensaje) ?></textarea>
              <span class="field__error" id="error-mensaje" role="alert"><?= $errores['mensaje'] ?? '' ?></span>
              <span class="field__hint" id="hint-mensaje">Máximo 600 caracteres · se publica con tu nombre</span>
            </div>

            <div class="entry__foot">
              <button class="stamp" type="submit">
                <span class="stamp__dot" aria-hidden="true"></span>
                Enviar testimonio
              </button>
              <span class="mono">Se registra en la base de datos</span>
            </div>

            <p class="printout printout--ok" role="status" <?= isset($_GET['enviado']) ? '' : 'hidden' ?>>
              <span class="printout__mark">REGISTRO OK —</span>
              <span>¡Gracias por tu testimonio!</span>
            </p>
            <p class="printout printout--err" role="alert" data-printout-error hidden>
              <span class="printout__mark">CORREGIR —</span>
              <span data-error-text>Revisa los campos marcados.</span>
            </p>
          </form>
        </div>
      </div>
    </section>

    <!-- Lámina 07 — contacto -->
    <section class="plate" id="lamina-07" aria-labelledby="contacto-title">
      <div class="plate__caption reveal">
        <h2 id="contacto-title">Contacto</h2>
        <p class="plate__code"><b>Lámina 07</b>Datos de la consulta</p>
      </div>

      <dl class="contact-grid reveal">
        <div class="contact-cell">
          <span class="contact-cell__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M4 5h4l2 5-2.5 2a12 12 0 0 0 4.5 4.5L14 14l5 2v4a1 1 0 0 1-1 1A15 15 0 0 1 3 6a1 1 0 0 1 1-1Z" /></svg>
          </span>
          <dt>Teléfono</dt>
          <dd><a href="tel:1234567890">(123) 456-7890</a></dd>
        </div>
        <div class="contact-cell">
          <span class="contact-cell__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M3 6h18v12H3z" /><path d="m3 6 9 7 9-7" /></svg>
          </span>
          <dt>Correo</dt>
          <dd><a href="mailto:contacto@vidaplena.com">contacto@vidaplena.com</a></dd>
        </div>
        <div class="contact-cell">
          <span class="contact-cell__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z" /><circle cx="12" cy="10" r="2.6" /></svg>
          </span>
          <dt>Dirección</dt>
          <dd>Calle Bienestar 123, Ciudad Saludable</dd>
        </div>
      </dl>

      <div class="contact-close reveal">
        <p>
          Cuéntame qué necesita la persona y qué quiere volver a hacer. Te respondo con el enfoque
          de trabajo y la disponibilidad de sesiones.
        </p>
        <a class="stamp" href="https://wa.me/593987384545?text=¡Hola!%20Quisiera%20más%20información%20sobre%20tus%20servicios%20de%20terapia%20ocupacional." target="_blank" rel="noopener">
          <span class="stamp__dot" aria-hidden="true"></span>
          Escribir por WhatsApp
        </a>
      </div>
    </section>
  </main>

  <footer class="site-foot">
    <div class="site-foot__inner">
      <span>© <?= date('Y') ?> Vida Plena — Terapia Ocupacional</span>
      <span>Láminas 01–07 · Atlas de movimiento</span>
    </div>
  </footer>

  <a class="float-action" href="https://wa.me/593987384545?text=¡Hola!%20Quisiera%20más%20información%20sobre%20tus%20servicios%20de%20terapia%20ocupacional." target="_blank" rel="noopener" aria-label="Chatear por WhatsApp">
    <svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor">
      <path d="M12.04 2C6.6 2 2.2 6.4 2.2 11.84c0 1.74.46 3.44 1.32 4.94L2 22l5.36-1.4a9.85 9.85 0 0 0 4.68 1.19h.01c5.43 0 9.84-4.4 9.84-9.84C21.89 6.4 17.47 2 12.04 2Zm0 17.94h-.01a8.2 8.2 0 0 1-4.16-1.14l-.3-.18-3.09.81.83-3.01-.2-.31a8.18 8.18 0 0 1-1.25-4.36c0-4.51 3.67-8.18 8.19-8.18 2.19 0 4.24.85 5.79 2.4a8.13 8.13 0 0 1 2.4 5.79c0 4.52-3.68 8.18-8.2 8.18Zm4.5-6.13c-.25-.12-1.46-.72-1.68-.8-.23-.09-.39-.13-.56.12-.16.25-.64.8-.78.97-.14.16-.29.18-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.84-.2-.48-.4-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.87.85-.87 2.07 0 1.22.89 2.4 1.01 2.56.12.16 1.75 2.67 4.23 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.21-.58.21-1.07.14-1.18-.06-.11-.22-.17-.47-.29Z" />
    </svg>
    <span class="float-action__label">WhatsApp</span>
  </a>

  <script src="js/index.js"></script>
</body>
</html>
