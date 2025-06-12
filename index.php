<?php
include('bd/conexion.php');

// Obtener los últimos 10 testimonios de la base de datos
$sentencia = $conexion->prepare("SELECT * FROM testimonios ORDER BY fecha DESC LIMIT 10");
$sentencia->execute();
$testimonios = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
    $errores['nombre'] = "El nombre es obligatorio."; // Validar que el nombre no esté vacío
  } elseif (!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u", $nombre)) { // Validar que el nombre solo contenga letras
    $errores['nombre'] = "El nombre solo debe contener letras.";
  } elseif (mb_strlen($nombre) > 100) { // Validar que el nombre no supere los 100 caracteres
    $errores['nombre'] = "El nombre no puede superar los 100 caracteres.";
  }

  if (empty($mensaje)) {
    $errores['mensaje'] = "El mensaje no puede estar vacío."; // Validar que el mensaje no esté vacío
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
      header("Location: index.php?enviado=1#testimonios");
      exit;
    } catch (PDOException $e) {
      echo "Error al insertar testimonio: " . $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terapia Ocupacional Vida Plena</title>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css"> </head>
<body>
  <header>
    <img src="img/logo.jpg" alt="Logo" class="logo">
    <h1>Vida Plena - Terapia Ocupacional</h1>
    <nav>
      <a href="#quien-soy">Quién soy</a>
      <a href="#servicios">Servicios</a>
      <a href="#galeria">Galería</a>
      <a href="#testimonios">Testimonios</a>
      <a href="#contacto">Contacto</a>
    </nav>
  </header>

  <div class="main-content-wrapper">
    <section class="section fade-in" id="inicio">
      <h2>Bienvenidos</h2>
      <p style="text-align: center; max-width: 700px; margin: auto;">
        En <strong>Vida Plena</strong> En Vida Plena, acompañamos a personas de todas las edades a desarrollar su independencia y bienestar a través de intervenciones personalizadas en terapia ocupacional. Nuestro enfoque se adapta a las necesidades de cada persona, promoviendo su autonomía, fortaleciendo sus habilidades y mejorando su calidad de vida de forma integral.
      </p>
    </section>

    <section id="quien-soy" class="seccion fade-in">
      <div class="contenedor quien-soy">
        <div class="foto-perfil">
          <img src="img/yo.jpg" alt="Tu foto de perfil">
        </div>
        <div class="descripcion-quien-soy">
          <h2>Quién soy</h2>
          <p>
            Soy terapeuta ocupacional, tengo formación en el área y me apasiona ayudar a las personas a mejorar su calidad de vida a través de este campo.
          </p>
        </div>
      </div>
    </section>

    <section class="section fade-in" id="servicios">
      <h2>Servicios</h2>
      <div class="services">
        <div class="card">
          <h3>Estimulación Cognitiva</h3>
          <p>
            Diseñamos programas personalizados para fortalecer funciones mentales como la memoria, la atención, la concentración y la planificación. Ideal para personas mayores, adultos con deterioro cognitivo o cualquier persona que desee mantener su mente activa y ágil en su vida diaria.
          </p>
        </div>
        <div class="card">
          <h3>Intervención Infantil</h3>
          <p>
            A través del juego y actividades terapéuticas, trabajamos el desarrollo motor, sensorial, cognitivo y social de niños que presentan desafíos en su crecimiento. Nuestro enfoque es cercano y divertido, fomentando la autonomía y la confianza en un entorno seguro y estimulante.
          </p>
        </div>
        <div class="card">
          <h3>Rehabilitación Física</h3>
          <p>
            Acompañamos el proceso de recuperación tras lesiones, cirugías o enfermedades neurológicas mediante técnicas específicas que promueven la movilidad, la coordinación y la independencia en las actividades cotidianas. Nuestro objetivo es ayudarte a retomar tu vida con seguridad y bienestar.
          </p>
        </div>
      </div>
    </section>

    <section class="section fade-in" id="galeria">
      <h2>Galería de Fotos</h2>
      <div class="gallery-scroll">
        <img src="img/trabajo.jpg" alt="foto1">
        <img src="img/trabajo.jpg" alt="foto2">
        <img src="img/trabajo.jpg" alt="foto3">
        <img src="img/trabajo.jpg" alt="foto4">
      </div>
    </section>

    <section class="section fade-in" id="testimonios">
      <h2>Testimonios</h2>
      <div class="testimonial-container" id="testimoniosContenedor">
        <?php foreach ($testimonios as $index): ?>
          <div class="testimonial">
            “<?= htmlspecialchars($index->mensaje) ?>”<br><br>
            <strong>– <?= htmlspecialchars($index->nombre) ?></strong>
            <p style="text-align: right;">(<?= date('d/m/Y', strtotime($index->fecha)) ?>)</p>
          </div>
        <?php endforeach; ?>
      </div>
      <form id="formTestimonio" action="index.php" method="POST">
        <h3>Envía tu testimonio</h3>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?= htmlspecialchars($nombre) ?>" required maxlength="100" />
        <?php if (!empty($errores['nombre'])) : ?>
          <p class="error"><?= $errores['nombre'] ?></p>
        <?php endif; ?>
        <textarea id="mensaje" name="mensaje" rows="4" placeholder="Escribe tu experiencia..." required maxlength="600"><?= htmlspecialchars($mensaje) ?></textarea>
        <?php if (!empty($errores['mensaje'])) : ?>
          <p class="error"><?= $errores['mensaje'] ?></p>
        <?php endif; ?>
        <button type="submit">Enviar Testimonio</button>
      </form>
      <?php if (isset($_GET['enviado'])): ?>
        <p class="success">¡Gracias por tu testimonio!</p>
      <?php endif; ?>
    </section>

    <section class="section fade-in" id="contacto">
      <h2>Contacto</h2>
      <p style="text-align: center;">
        📞 Teléfono: (123) 456-7890<br>
        📧 Correo: contacto@vidaplena.com<br>
        📍 Dirección: Calle Bienestar 123, Ciudad Saludable
      </p>
    </section>

    <footer>
      &copy; 2025 Vida Plena - Terapia Ocupacional. Todos los derechos reservados.
    </footer>
  </div> 
    </div>
  </div>
  <script src="js/index.js"></script>
  <a href="https://wa.me/593987384545?text=¡Hola!%20Quisiera%20más%20información%20sobre%20tus%20servicios%20de%20terapia%20ocupacional." class="whatsapp" target="_blank" aria-label="Chatea con nosotros por WhatsApp">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
  </a>
</body>
</html>