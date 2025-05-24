<?php
include('bd/conexion.php');
$sentencia=$conexion->prepare("SELECT * FROM testimonios ORDER BY fecha DESC LIMIT 10");
$sentencia->execute();
$testimonios=$sentencia->fetchAll(PDO::FETCH_OBJ);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'], $_POST['mensaje'])) {

  // Limpiar los datos del formulario
  $nombre = trim($_POST['nombre']);
  $mensaje = trim($_POST['mensaje']);

  // Validar los datos
  if (empty($nombre)) {
    $errores['nombre'] = "El nombre es obligatorio.";
  }

  if (empty($mensaje)) {
    $errores['mensaje'] = "El testimonio no puede estar vacío.";
  }

  try {
      // Preparar la consulta segura con PDO
      $stmt = $conexion->prepare("INSERT INTO testimonios (nombre, mensaje) VALUES (:nombre, :mensaje)");
      $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
      $stmt->execute();

      // Redirigir para evitar reenvío al recargar la página
      header("Location: index.php#testimonios");
      exit;
  } catch (PDOException $e) {
      echo "Error al insertar testimonio: " . $e->getMessage();
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
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

  <header>
    <!-- Logo circular -->
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

  <section class="section fade-in" id="inicio">
    <h2>Bienvenidos</h2>
    <p style="text-align: center; max-width: 700px; margin: auto;">
      En <strong>Vida Plena</strong> nos dedicamos a acompañar a personas de todas las edades en el desarrollo de su independencia y bienestar mediante estrategias de intervención personalizadas en terapia ocupacional.
    </p>
  </section>

  <section id="quien-soy" class="seccion">
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
        <p>Ejercicios personalizados para fortalecer la memoria, atención y funciones ejecutivas.</p>
      </div>
      <div class="card">
        <h3>Intervención Infantil</h3>
        <p>Actividades lúdicas orientadas al desarrollo motor, sensorial y social en niños.</p>
      </div>
      <div class="card">
        <h3>Rehabilitación Física</h3>
        <p>Programas para recuperar la autonomía en actividades cotidianas tras lesiones o enfermedades.</p>
      </div>
    </div>
  </section>

  <!-- Galería con scroll -->
  <section class="section fade-in" id="galeria">
    <h2>Galería de Fotos</h2>
    <div class="gallery-scroll">
      <img src="https://source.unsplash.com/400x200/?therapy" alt="foto1">
      <img src="https://source.unsplash.com/400x200/?rehabilitation" alt="foto2">
      <img src="https://source.unsplash.com/400x200/?child-therapy" alt="foto3">
      <img src="https://source.unsplash.com/400x200/?healthcare" alt="foto4">
    </div>
  </section>

  <!-- Testimonios con scroll -->
  <section class="section fade-in" id="testimonios">
    <h2>Testimonios</h2>
    <div class="testimonial-container" id="testimoniosContenedor">
      <?php foreach ($testimonios as $index) { ?>
        <div class="testimonial">
          “<?php echo $index->mensaje ?>”<br><br><strong>– <?php echo $index->nombre ?></strong> <p style="text-align: right;">(<?php echo date('d/m/Y', strtotime($index->fecha));?>)</p>
        </div>
      <?php } ?>
    </div>

    <form id="formTestimonio" action="index.php" method="POST">
      <h3>Envía tu testimonio</h3>
      <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required />
      <textarea id="mensaje" name="mensaje" rows="4" placeholder="Escribe tu experiencia..." required></textarea>
      <button type="submit">Enviar Testimonio</button>
    </form>
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

  <script src="js/index.js"></script>
  <!-- Botón de WhatsApp -->
  <a href="https://wa.me/593987384545?text=¡Hola!%20Quisiera%20más%20información%20sobre%20tus%20servicios%20de%20terapia%20ocupacional." class="whatsapp" target="_blank" aria-label="Chatea con nosotros por WhatsApp">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
  </a>
</body>
</html>
