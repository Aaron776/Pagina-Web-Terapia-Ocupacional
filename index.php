<?php
include('bd/conexion.php');
$sentencia = $conexion->prepare("SELECT * FROM testimonios ORDER BY fecha DESC LIMIT 10");
$sentencia->execute();
$testimonios = $sentencia->fetchAll(PDO::FETCH_OBJ);
$galeria_dir = __DIR__ . '/img/trabajo';
$galeria = [];
if (is_dir($galeria_dir)) {
  $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
  foreach (scandir($galeria_dir) as $archivo) {
    if (!in_array(strtolower(pathinfo($archivo, PATHINFO_EXTENSION)), $permitidos, true)) continue;
    $medidas = getimagesize($galeria_dir . '/' . $archivo);
    $galeria[] = [
      'src' => 'img/trabajo/' . $archivo, 'alt' => 'Fotografía de una sesión de terapia ocupacional',
      'label' => 'Una mirada a las sesiones', 'zoom' => 1, 'ox' => '50%', 'oy' => '50%',
      'w' => $medidas ? $medidas[0] : null, 'h' => $medidas ? $medidas[1] : null,
    ];
  }
}
if (empty($galeria)) {
  $galeria = [
    ['src' => 'img/trabajo.jpg', 'label' => 'Sesión de terapia ocupacional', 'zoom' => 1, 'ox' => '50%', 'oy' => '50%', 'alt' => 'Terapeuta acompañando una actividad de coordinación en una sesión', 'w' => 474, 'h' => 314],
    ['src' => 'img/trabajo.jpg', 'label' => 'Detalle de la misma fotografía · 1,5×', 'zoom' => 1.5, 'ox' => '30%', 'oy' => '40%', 'alt' => 'Detalle ampliado de la misma fotografía de sesión', 'w' => 474, 'h' => 314],
    ['src' => 'img/trabajo.jpg', 'label' => 'Detalle de la misma fotografía · 2×', 'zoom' => 2, 'ox' => '68%', 'oy' => '60%', 'alt' => 'Segundo detalle ampliado de la misma fotografía de sesión', 'w' => 474, 'h' => 314],
  ];
}
$galeria_total = count($galeria);
$galeria_fotos = count(array_unique(array_column($galeria, 'src')));
$errores = [];
$nombre = '';
$mensaje = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'], $_POST['mensaje'])) {
  $nombre = trim($_POST['nombre']);
  $mensaje = trim($_POST['mensaje']);
  if (empty($nombre)) {
    $errores['nombre'] = "El nombre es obligatorio.";
  } elseif (!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u", $nombre)) {
    $errores['nombre'] = "El nombre solo debe contener letras.";
  } elseif (mb_strlen($nombre) > 100) {
    $errores['nombre'] = "El nombre no puede superar los 100 caracteres.";
  }
  if (empty($mensaje)) {
    $errores['mensaje'] = "El mensaje no puede estar vacío.";
  } elseif (mb_strlen($mensaje) > 600) {
    $errores['mensaje'] = "El mensaje no puede superar los 600 caracteres.";
  }
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
$whatsapp = 'https://wa.me/593987384545?text=' . rawurlencode('¡Hola! Quisiera más información sobre tus servicios de terapia ocupacional.');
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#f3f0fa" />
  <meta name="description" content="Vida Plena: terapia ocupacional para niños, adultos y personas mayores. Un acompañamiento cercano para ganar autonomía en las actividades de cada día." />
  <title>Vida Plena — Terapia Ocupacional</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
  <svg class="icon-library" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <defs>
      <symbol id="icon-arrow" viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6" /></symbol>
      <symbol id="icon-child" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2.3" /><path d="m5 10 7 3 7-3M12 13v4m0 0-4 5m4-5 4 5" /></symbol>
      <symbol id="icon-mind" viewBox="0 0 24 24"><path d="M9 21v-4H7a3 3 0 0 1-3-3v-2H2l2-5a8 8 0 0 1 15 4v3l2 7M10 6v6m-3-3h6" /></symbol>
      <symbol id="icon-move" viewBox="0 0 24 24"><circle cx="15" cy="4" r="2" /><path d="m11 9 3-2 3 5 4 1M14 7l-3 8-6 2m6-2 5 6M4 9l4-1" /></symbol>
      <symbol id="icon-heart" viewBox="0 0 24 24"><path d="M20 5a5 5 0 0 0-8 1 5 5 0 0 0-8-1C0 9 5 15 12 21c7-6 12-12 8-16Z" /></symbol>
      <symbol id="icon-chat" viewBox="0 0 24 24"><path d="M20 11a8 8 0 0 1-8 8H5l-4 3 2-6a8 8 0 1 1 17-5Z" /><path d="M7 10h9M7 14h6" /></symbol>
      <symbol id="icon-check" viewBox="0 0 24 24"><path d="m5 12 4 4L19 6" /></symbol>
      <symbol id="icon-phone" viewBox="0 0 24 24"><path d="M5 3h4l2 5-3 2a13 13 0 0 0 6 6l2-3 5 2v4a2 2 0 0 1-2 2A18 18 0 0 1 3 5a2 2 0 0 1 2-2Z" /></symbol>
      <symbol id="icon-mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="m3 6 9 7 9-7" /></symbol>
      <symbol id="icon-pin" viewBox="0 0 24 24"><path d="M19 10c0 5-7 12-7 12S5 15 5 10a7 7 0 1 1 14 0Z" /><circle cx="12" cy="10" r="2.5" /></symbol>
    </defs>
  </svg>
  <a class="skip-link" href="#contenido">Ir al contenido</a>
  <header class="site-head">
    <div class="site-head__inner">
      <a class="brand" href="#lamina-01" aria-label="Vida Plena, inicio">
        <img class="brand__logo" src="img/logo.jpg" alt="" width="54" height="54" />
        <span><span class="brand__name">Vida Plena<span class="brand__period">.</span></span><span class="brand__kind">Terapia ocupacional</span></span>
      </a>
      <button class="menu-toggle" type="button" aria-controls="site-navigation" aria-expanded="false"><span>Menú</span><span class="menu-toggle__lines" aria-hidden="true"></span></button>
      <nav class="plate-index" id="site-navigation" aria-label="Navegación principal">
        <a href="#lamina-02">Quién soy</a><a href="#lamina-03">Servicios</a><a href="#lamina-04">Cómo trabajamos</a><a href="#lamina-05">El trabajo</a><a href="#lamina-06">Testimonios</a><a href="#lamina-07">Contacto</a>
      </nav>
      <a class="button button--small site-head__cta" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Hablemos <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
    </div>
  </header>
  <main id="contenido">
    <section class="hero" id="lamina-01" aria-labelledby="cover-title">
      <div class="container hero__grid">
        <div class="hero__copy">
          <h1 id="cover-title">Volver a disfrutar de <em>lo cotidiano.</em></h1>
          <p>Terapia ocupacional para ganar autonomía, descubrir posibilidades y avanzar a tu ritmo. Para ti y para las personas que más quieres.</p>
          <div class="hero__actions">
            <a class="button" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Cuéntame cómo puedo ayudarte <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
            <a class="text-link" href="#lamina-03">Conoce los servicios <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
          </div>
          <div class="hero__reassurance"><svg class="icon" aria-hidden="true"><use href="#icon-heart" /></svg><span>Atención individual. Un plan pensado para cada persona.</span></div>
        </div>
        <div class="hero__visual" data-tilt>
          <div class="hero__photo"><img src="img/trabajo.jpg" width="474" height="314" alt="Una terapeuta acompaña a un adulto en una actividad de coordinación con las manos" fetchpriority="high" /></div>
          <div class="hero__message"><span class="hero__message-icon"><svg class="icon" aria-hidden="true"><use href="#icon-heart" /></svg></span><p>Pequeños pasos.<br /><strong>Grandes posibilidades.</strong></p></div>
          <div class="hero__mascot" aria-hidden="true">
            <img src="img/personaje-terapia.png" width="480" height="480" alt="" decoding="async" />
          </div>
          <span class="hero__orbit" aria-hidden="true"></span>
          <svg class="hero__spark" viewBox="0 0 80 80" fill="none" aria-hidden="true"><path d="M40 5v23M40 52v23M5 40h23M52 40h23M15 15l16 16M49 49l16 16M15 65l16-16M49 31l16-16" stroke="currentColor" stroke-width="4" stroke-linecap="round" /></svg>
        </div>
      </div>
      <div class="container audience" aria-label="Encuentra tu acompañamiento">
        <p>Un espacio para<br /><strong>cada etapa de la vida.</strong></p>
        <a href="#servicio-infantil"><svg class="icon" aria-hidden="true"><use href="#icon-child" /></svg><span>Infancia</span><svg class="icon audience__arrow" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
        <a href="#servicio-fisico"><svg class="icon" aria-hidden="true"><use href="#icon-move" /></svg><span>Personas adultas</span><svg class="icon audience__arrow" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
        <a href="#servicio-cognitivo"><svg class="icon" aria-hidden="true"><use href="#icon-mind" /></svg><span>Personas mayores</span><svg class="icon audience__arrow" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
      </div>
    </section>
    <section class="section about" id="lamina-02" aria-labelledby="quien-title">
      <div class="container about__grid">
        <figure class="about__portrait" data-tilt>
          <img src="img/yo.jpg" alt="La terapeuta de Vida Plena" width="640" height="640" loading="lazy" />
          <figcaption><svg class="icon" aria-hidden="true"><use href="#icon-heart" /></svg>Una persona acompañando a otra.</figcaption>
        </figure>
        <div class="about__copy">
          <h2 id="quien-title">Hola, soy quien te acompaña en <em>el siguiente paso.</em></h2>
          <p class="lead">Soy terapeuta ocupacional. Trabajo contigo en esas actividades que hacen que tu día sea realmente tuyo.</p>
          <p>Mi punto de partida es escucharte: qué te cuesta hoy, qué quieres volver a hacer y qué recursos tienes a mano. Desde ahí construimos un plan que combina juego, movimiento y ejercicio mental, respetando tu ritmo.</p>
          <p>No se trata solo de entrenar una habilidad, sino de que te sirva en casa, en la escuela o en el trabajo.</p>
          <ul class="care-points">
            <li><svg class="icon" aria-hidden="true"><use href="#icon-check" /></svg>Sesiones individuales con objetivos para tu vida diaria.</li>
            <li><svg class="icon" aria-hidden="true"><use href="#icon-check" /></svg>Acompañamiento a niños, adultos y personas mayores.</li>
            <li><svg class="icon" aria-hidden="true"><use href="#icon-check" /></svg>En consulta y en el entorno real de la persona.</li>
          </ul>
          <a class="text-link" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Me gustaría conversar <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a>
        </div>
      </div>
    </section>
    <section class="section services" id="lamina-03" aria-labelledby="servicios-title">
      <div class="container services__grid">
        <div class="services__intro">
          <h2 id="servicios-title">Diferentes necesidades.<br /><em>El mismo cuidado.</em></h2>
          <p>Un acompañamiento que parte de lo que necesitas y se convierte en herramientas para cada día.</p>
          <div class="services__question"><svg class="icon" aria-hidden="true"><use href="#icon-chat" /></svg><p>¿No sabes por dónde empezar?<br /><a href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Cuéntame tu situación.</a></p></div>
        </div>
        <div class="services__list">
          <details class="service" id="servicio-cognitivo" open>
            <summary><span class="service__icon service__icon--lavender"><svg class="icon" aria-hidden="true"><use href="#icon-mind" /></svg></span><h3 class="service__heading"><span class="service__title">Estimulación cognitiva</span><span class="service__audience">Memoria, atención y planificación</span></h3><span class="service__toggle" aria-hidden="true"></span></summary>
            <div class="service__body"><p>Ejercicios y tareas cotidianas para mantener activas la memoria, la atención y la concentración: organizar la semana, recordar una receta, manejar dinero o sostener una conversación.</p><p>Para personas mayores, adultos con deterioro cognitivo y quienes quieren conservar su agudeza mental.</p><a class="text-link" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Consultar este servicio <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a></div>
          </details>
          <details class="service" id="servicio-infantil">
            <summary><span class="service__icon service__icon--peach"><svg class="icon" aria-hidden="true"><use href="#icon-child" /></svg></span><h3 class="service__heading"><span class="service__title">Intervención infantil</span><span class="service__audience">Crecer, jugar y descubrir</span></h3><span class="service__toggle" aria-hidden="true"></span></summary>
            <div class="service__body"><p>A través del juego trabajamos el desarrollo motor, sensorial, cognitivo y social de niños y niñas que encuentran dificultades en su crecimiento.</p><p>En un entorno cercano y seguro, las metas se traducen en cosas concretas: sostener el lápiz, vestirse, coordinar el cuerpo o jugar con otros.</p><a class="text-link" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Consultar este servicio <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a></div>
          </details>
          <details class="service" id="servicio-fisico">
            <summary><span class="service__icon service__icon--mint"><svg class="icon" aria-hidden="true"><use href="#icon-move" /></svg></span><h3 class="service__heading"><span class="service__title">Rehabilitación física</span><span class="service__audience">Movimiento para tu vida diaria</span></h3><span class="service__toggle" aria-hidden="true"></span></summary>
            <div class="service__body"><p>Acompañamiento después de una lesión, una cirugía o una enfermedad neurológica. Trabajamos la movilidad, la coordinación y la fuerza aplicada a las actividades de cada día.</p><p>El objetivo es volver a levantarte, caminar, bañarte o cocinar con mayor seguridad y autonomía.</p><a class="text-link" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Consultar este servicio <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a></div>
          </details>
        </div>
      </div>
    </section>
    <section class="section journey" id="lamina-04" aria-labelledby="recorrido-title">
      <div class="container">
        <div class="section-heading section-heading--light"><h2 id="recorrido-title">No tienes que tenerlo todo claro.<br /><em>Empezamos paso a paso.</em></h2><p>Así construimos juntos un camino que tenga sentido para ti.</p></div>
        <div class="sequence">
          <article class="step"><span class="step__no">01</span><h3>Primero, te escucho</h3><p>Conversamos para entender qué necesitas, qué haces hoy sin dificultad y dónde está el obstáculo. Ese es nuestro punto de partida.</p><span class="step__label">Valoración</span></article>
          <article class="step"><span class="step__no">02</span><h3>Diseñamos tu plan</h3><p>Elegimos actividades y ejercicios para tu objetivo, con una progresión clara y ajustes según tu respuesta.</p><span class="step__label">Plan personalizado</span></article>
          <article class="step"><span class="step__no">03</span><h3>Avanzamos contigo</h3><p>Seguimos el progreso en tu vida diaria. La familia forma parte del proceso cuando ayuda a alcanzar tus objetivos.</p><span class="step__label">Acompañamiento</span></article>
        </div>
      </div>
    </section>
    <section class="section work" id="lamina-05" aria-labelledby="trabajo-title">
      <div class="container work__grid">
        <div class="slider slider--photos" data-slider role="region" aria-roledescription="carrusel" aria-label="Fotografías del trabajo">
          <ul class="slider__track" data-track tabindex="0" aria-label="Fotografías. Usa las flechas para navegar.">
            <?php foreach ($galeria as $i => $foto): ?>
              <li class="slider__slide" role="group" aria-roledescription="diapositiva" aria-label="<?= ($i + 1) . ' de ' . $galeria_total ?>">
                <figure class="sheet-frame">
                  <div class="sheet-frame__media" style="--zoom: <?= htmlspecialchars($foto['zoom']) ?>; --ox: <?= htmlspecialchars($foto['ox']) ?>; --oy: <?= htmlspecialchars($foto['oy']) ?>"><img src="<?= htmlspecialchars($foto['src']) ?>" alt="<?= htmlspecialchars($foto['alt']) ?>"<?= $foto['w'] ? ' width="' . (int) $foto['w'] . '" height="' . (int) $foto['h'] . '"' : '' ?> loading="lazy" /></div>
                  <figcaption class="sheet-frame__meta"><?= htmlspecialchars($foto['label']) ?></figcaption>
                </figure>
              </li>
            <?php endforeach; ?>
          </ul>
          <div class="slider__controls">
            <button type="button" class="slider__btn" data-slider-prev aria-label="Fotografía anterior"><svg class="icon icon--back" aria-hidden="true"><use href="#icon-arrow" /></svg></button>
            <ol class="slider__dots"><?php foreach ($galeria as $i => $foto): ?><li><button type="button" class="slider__dot<?= $i === 0 ? ' is-active' : '' ?>" data-slider-dot="<?= $i ?>" aria-label="Ver fotografía <?= $i + 1 ?>"<?= $i === 0 ? ' aria-current="true"' : '' ?>></button></li><?php endforeach; ?></ol>
            <button type="button" class="slider__btn" data-slider-next aria-label="Fotografía siguiente"><svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></button>
          </div>
        </div>
        <div class="work__copy"><h2 id="trabajo-title">El trabajo empieza en una sesión.<br /><em>Continúa en tu vida.</em></h2><p>Jugar, cocinar, escribir, vestirse. Detrás de cada actividad hay habilidades que podemos trabajar juntos.</p><p>Este espacio reúne el registro de las sesiones: materiales, ejercicios y momentos del proceso.</p><p class="work__note"><?= $galeria_fotos ?> fotografía<?= $galeria_fotos === 1 ? '' : 's' ?> disponible<?= $galeria_fotos === 1 ? '' : 's' ?>.<?php if ($galeria_fotos === 1 && $galeria_total > 1): ?> Las otras vistas son detalles de la misma toma.<?php endif; ?></p><a class="text-link" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Hablemos de tus objetivos <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a></div>
      </div>
    </section>
    <section class="section experiences" id="lamina-06" aria-labelledby="testimonios-title">
      <div class="container">
        <div class="section-heading"><h2 id="testimonios-title">Cada persona tiene<br /><em>una historia que contar.</em></h2><p>Experiencias compartidas en Vida Plena.</p></div>
        <div class="records">
          <?php if (empty($testimonios)): ?><p class="record-empty">Aún no hay testimonios registrados. El primero puede ser el tuyo.</p>
          <?php else: ?>
            <div class="slider slider--records" data-slider role="region" aria-roledescription="carrusel" aria-label="Testimonios">
              <ul class="slider__track" data-track tabindex="0" aria-label="Testimonios. Usa las flechas para navegar.">
                <?php foreach ($testimonios as $i => $index): ?>
                  <li class="slider__slide" role="group" aria-roledescription="diapositiva" aria-label="<?= ($i + 1) . ' de ' . count($testimonios) ?>">
                    <figure class="record"><svg class="record__quotation" viewBox="0 0 48 40" aria-hidden="true"><path d="M3 36V22C3 10 8 4 20 2v8c-6 2-8 5-8 10h9v16H3Zm25 0V22C28 10 33 4 45 2v8c-6 2-8 5-8 10h9v16H28Z" fill="currentColor" /></svg><blockquote class="record__quote">“<?= htmlspecialchars($index->mensaje) ?>”</blockquote><figcaption class="record__head"><span class="record__avatar" aria-hidden="true"><?= htmlspecialchars(mb_substr($index->nombre, 0, 1)) ?></span><span><span class="record__who"><?= htmlspecialchars($index->nombre) ?></span><time class="record__date" datetime="<?= date('Y-m-d', strtotime($index->fecha)) ?>"><?= date('d/m/Y', strtotime($index->fecha)) ?></time></span></figcaption></figure>
                  </li>
                <?php endforeach; ?>
              </ul>
              <div class="slider__controls"><button type="button" class="slider__btn" data-slider-prev aria-label="Testimonio anterior"><svg class="icon icon--back" aria-hidden="true"><use href="#icon-arrow" /></svg></button><span class="slider__counter" data-slider-counter aria-live="polite" aria-atomic="true">01 / <?= count($testimonios) ?></span><button type="button" class="slider__btn" data-slider-next aria-label="Testimonio siguiente"><svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></button></div>
            </div>
          <?php endif; ?>
          <div class="entry">
            <h3>Tu experiencia también cuenta.</h3><p>Si has pasado por aquí, me encantará leerte.</p>
            <form id="formTestimonio" action="index.php#lamina-06" method="POST" novalidate>
              <div class="field<?= !empty($errores['nombre']) ? ' is-invalid' : '' ?>"><label for="nombre">Tu nombre</label><input type="text" id="nombre" name="nombre" placeholder="¿Cómo te llamas?" value="<?= htmlspecialchars($nombre) ?>" required maxlength="100" autocomplete="name" aria-describedby="error-nombre" /><span class="field__error" id="error-nombre" role="alert"><?= $errores['nombre'] ?? '' ?></span></div>
              <div class="field<?= !empty($errores['mensaje']) ? ' is-invalid' : '' ?>"><label for="mensaje">Tu experiencia</label><textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos cómo ha sido tu proceso..." required maxlength="600" aria-describedby="error-mensaje hint-mensaje"><?= htmlspecialchars($mensaje) ?></textarea><span class="field__error" id="error-mensaje" role="alert"><?= $errores['mensaje'] ?? '' ?></span><span class="field__hint" id="hint-mensaje">Máximo 600 caracteres. Se publica con tu nombre.</span></div>
              <button class="button" type="submit">Compartir mi experiencia <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></button>
              <p class="printout printout--ok" role="status" <?= isset($_GET['enviado']) ? '' : 'hidden' ?>>¡Gracias por compartir tu experiencia!</p>
              <p class="printout printout--err" role="alert" data-printout-error hidden><span data-error-text>Revisa los campos marcados.</span></p>
            </form>
          </div>
        </div>
      </div>
    </section>
    <section class="section contact" id="lamina-07" aria-labelledby="contacto-title">
      <div class="container">
        <div class="contact__invitation"><span class="contact__heart" aria-hidden="true"><svg class="icon"><use href="#icon-heart" /></svg></span><h2 id="contacto-title">Tu siguiente paso<br />puede ser <em>una conversación.</em></h2><p>Cuéntame qué necesitas y qué te gustaría volver a hacer. Te responderé con el enfoque de trabajo y la disponibilidad de sesiones.</p><a class="button" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener">Hablemos por WhatsApp <svg class="icon" aria-hidden="true"><use href="#icon-arrow" /></svg></a></div>
        <dl class="contact-grid">
          <div class="contact-cell"><svg class="icon" aria-hidden="true"><use href="#icon-phone" /></svg><dt>Llámame</dt><dd><a href="tel:1234567890">(123) 456-7890</a></dd></div>
          <div class="contact-cell"><svg class="icon" aria-hidden="true"><use href="#icon-mail" /></svg><dt>Escríbeme</dt><dd><a href="mailto:contacto@vidaplena.com">contacto@vidaplena.com</a></dd></div>
          <div class="contact-cell"><svg class="icon" aria-hidden="true"><use href="#icon-pin" /></svg><dt>Encuéntrame</dt><dd>Calle Bienestar 123, Ciudad Saludable</dd></div>
        </dl>
      </div>
    </section>
  </main>
  <footer class="site-foot"><div class="container site-foot__inner"><a class="brand" href="#lamina-01"><span class="brand__name">Vida Plena.</span></a><p>Más autonomía. Más posibilidades. Más vida.</p><span>© <?= date('Y') ?> Vida Plena — Terapia Ocupacional</span></div></footer>
  <a class="float-action" href="<?= htmlspecialchars($whatsapp) ?>" target="_blank" rel="noopener" aria-label="Chatear por WhatsApp"><svg class="icon" aria-hidden="true"><use href="#icon-chat" /></svg><span>¿Hablamos?</span></a>
  <script src="js/index.js"></script>
</body>
</html>
