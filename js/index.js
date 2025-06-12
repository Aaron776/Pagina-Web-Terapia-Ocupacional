// Animaciones
const fadeElements = document.querySelectorAll('.fade-in');
function handleScroll() {
  fadeElements.forEach(el => {
    const rect = el.getBoundingClientRect();
    if (rect.top < window.innerHeight - 100 && rect.bottom > 100) {
      el.classList.add('show');
    } else {
      el.classList.remove('show');
    }
  });
}
window.addEventListener('scroll', handleScroll);
window.addEventListener('load', handleScroll);


// Validaciones para el Formulario de Testimonios
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formTestimonio");
  const nombreInput = document.getElementById("nombre");
  const mensajeInput = document.getElementById("mensaje");

  form.addEventListener("submit", function (e) {
    let errores = {};

    const nombre = nombreInput.value.trim();
    const mensaje = mensajeInput.value.trim();

    // Validar nombre
    if (!nombre) {
      errores.nombre = "El nombre es obligatorio.";
    } else if (!/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) {
      errores.nombre = "El nombre solo debe contener letras.";
    } else if (nombre.length > 100) {
      errores.nombre = "El nombre no puede superar los 100 caracteres.";
    }

    // Validar mensaje
    if (!mensaje) {
      errores.mensaje = "El mensaje no puede estar vacío.";
    } else if (mensaje.length > 600) {
      errores.mensaje = "El mensaje no puede superar los 600 caracteres.";
    }

    // Limpiar mensajes de error anteriores
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    // Mostrar errores
    if (Object.keys(errores).length > 0) {
      e.preventDefault();
      if (errores.nombre) {
        mostrarError("nombre", errores.nombre);
      }
      if (errores.mensaje) {
        mostrarError("mensaje", errores.mensaje);
      }
    }
  });

  function mostrarError(campoId, mensaje) {
    let campo = document.getElementById(campoId);
    let parrafoError = campo.nextElementSibling;

    // Si el siguiente elemento no es un párrafo de error, lo creamos
    if (!parrafoError || !parrafoError.classList.contains("error")) {
      parrafoError = document.createElement("p");
      parrafoError.classList.add("error");
      campo.parentNode.insertBefore(parrafoError, campo.nextSibling);
    }

    parrafoError.textContent = mensaje;
  }
});

  // Oculta el mensaje de éxito automáticamente después de 5 segundos
  document.addEventListener("DOMContentLoaded", () => {
    const successMsg = document.querySelector(".success");
    if (successMsg) {
      setTimeout(() => {
        successMsg.style.transition = "opacity 0.5s ease";
        successMsg.style.opacity = "0";
        setTimeout(() => successMsg.remove(), 500); // Elimina el elemento después
      }, 5000); // 5 segundos
    }
  });
