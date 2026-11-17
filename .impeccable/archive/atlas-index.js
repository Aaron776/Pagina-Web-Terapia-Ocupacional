// Archived: Atlas interaction implementation.

document.documentElement.classList.remove('no-js');
document.documentElement.classList.add('js');

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// --- Revelado por scroll ---------------------------------------------------
const revealTargets = document.querySelectorAll('.reveal');

if (!('IntersectionObserver' in window) || prefersReducedMotion) {
  revealTargets.forEach((el) => el.classList.add('is-visible'));
} else {
  const revealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    },
    { rootMargin: '0px 0px -12% 0px', threshold: 0.12 }
  );

  revealTargets.forEach((el) => revealObserver.observe(el));
}

// --- Trazado del arco de rango --------------------------------------------
const arcLayer = document.querySelector('.fig-arc');
if (arcLayer) {
  const draw = () => arcLayer.classList.add('is-drawn');
  if (prefersReducedMotion) {
    arcLayer.classList.add('is-drawn');
  } else {
    requestAnimationFrame(() => window.setTimeout(draw, 260));
  }
}

// --- Reflejo de la lámina: figura y arco devueltos por la placa ------------
(() => {
  const target = document.querySelector('[data-scene]');
  if (!target) return;
  const arc = target.querySelector('[data-draw]');
  const figure = target.querySelector('[data-figure]');
  if (!figure) return;

  const mirror = document.createElement('div');
  mirror.className = 'fig-mirror';
  mirror.setAttribute('aria-hidden', 'true');

  const inner = document.createElement('div');
  inner.className = 'fig-mirror__inner';

  [arc, figure].forEach((node) => {
    if (!node) return;
    const clone = node.cloneNode(true);
    clone.removeAttribute('data-figure');
    clone.removeAttribute('data-draw');
    clone.removeAttribute('id');
    if (node === arc) clone.classList.add('is-drawn');
    inner.appendChild(clone);
  });

  mirror.appendChild(inner);
  target.appendChild(mirror);
})();

// --- Parallax de la escena (interacción firma) -----------------------------
const scene = document.querySelector('[data-scene]');
if (scene && !prefersReducedMotion && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
  let frame = null;

  const apply = (nx, ny) => {
    scene.style.setProperty('--nx', nx.toFixed(3));
    scene.style.setProperty('--ny', ny.toFixed(3));
    scene.style.setProperty('--rx', `${(-ny * 7).toFixed(2)}deg`);
    scene.style.setProperty('--ry', `${(nx * 13).toFixed(2)}deg`);
  };

  scene.addEventListener('pointermove', (event) => {
    const rect = scene.getBoundingClientRect();
    const nx = ((event.clientX - rect.left) / rect.width - 0.5) * 2;
    const ny = ((event.clientY - rect.top) / rect.height - 0.5) * 2;
    if (frame) cancelAnimationFrame(frame);
    frame = requestAnimationFrame(() => apply(nx, ny));
  });

  scene.addEventListener('pointerleave', () => {
    if (frame) cancelAnimationFrame(frame);
    apply(0, 0);
  });
}

// --- Carrusel del registro fotográfico (Lámina 05) -------------------------
document.querySelectorAll('[data-slider]').forEach((slider) => {
  const track = slider.querySelector('[data-track]');
  if (!track) return;

  const slides = Array.from(track.children);
  const dots = Array.from(slider.querySelectorAll('[data-slider-dot]'));
  const prev = slider.querySelector('[data-slider-prev]');
  const next = slider.querySelector('[data-slider-next]');
  const counter = slider.querySelector('[data-slider-counter]');

  if (slides.length < 2) {
    slider.classList.add('is-single');
    return;
  }

  const step = () => slides[0].getBoundingClientRect().width;
  const current = () => {
    const width = step();
    return width ? Math.round(track.scrollLeft / width) : 0;
  };
  const goTo = (index, behavior) => {
    const target = Math.max(0, Math.min(slides.length - 1, index));
    track.scrollTo({
      left: target * step(),
      behavior: behavior || (prefersReducedMotion ? 'auto' : 'smooth'),
    });
  };
  const sync = () => {
    const index = Math.max(0, Math.min(slides.length - 1, current()));
    if (!prefersReducedMotion) {
      const position = track.scrollLeft / (step() || 1);
      slides.forEach((slide, i) => {
        const distance = Math.min(1, Math.abs(i - position));
        slide.style.setProperty('--slide-angle', `${Math.max(-1, Math.min(1, i - position)) * -9}deg`);
        slide.style.setProperty('--slide-scale', String(1 - distance * 0.045));
        slide.style.setProperty('--slide-opacity', String(1 - distance * 0.25));
      });
    }
    dots.forEach((dot, d) => {
      const active = d === index;
      dot.classList.toggle('is-active', active);
      if (active) dot.setAttribute('aria-current', 'true');
      else dot.removeAttribute('aria-current');
    });
    if (prev) prev.disabled = index <= 0;
    if (next) next.disabled = index >= slides.length - 1;
    if (counter) {
      const pad = (n) => String(n).padStart(2, '0');
      counter.textContent = pad(index + 1) + ' / ' + pad(slides.length);
    }
  };

  let ticking = false;
  track.addEventListener(
    'scroll',
    () => {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(() => {
        sync();
        ticking = false;
      });
    },
    { passive: true }
  );

  if (prev) prev.addEventListener('click', () => goTo(current() - 1));
  if (next) next.addEventListener('click', () => goTo(current() + 1));
  dots.forEach((dot) => {
    dot.addEventListener('click', () => goTo(Number(dot.dataset.sliderDot)));
  });

  track.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowRight') {
      event.preventDefault();
      goTo(current() + 1);
    } else if (event.key === 'ArrowLeft') {
      event.preventDefault();
      goTo(current() - 1);
    } else if (event.key === 'Home') {
      event.preventDefault();
      goTo(0);
    } else if (event.key === 'End') {
      event.preventDefault();
      goTo(slides.length - 1);
    }
  });

  window.addEventListener('resize', () => goTo(current(), 'auto'));

  sync();
});

// --- Profundidad de las láminas: solo dispositivos con puntero preciso ----
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');
if (!prefersReducedMotion && finePointer.matches) {
  document.querySelectorAll('.specimen, .procedure__diagram').forEach((plane) => {
    plane.classList.add('depth-plane');
    let frame = null;
    plane.addEventListener('pointermove', (event) => {
      if (frame) cancelAnimationFrame(frame);
      frame = requestAnimationFrame(() => {
        const rect = plane.getBoundingClientRect();
        const x = Math.max(-1, Math.min(1, (event.clientX - rect.left) / rect.width * 2 - 1));
        const y = Math.max(-1, Math.min(1, (event.clientY - rect.top) / rect.height * 2 - 1));
        plane.classList.add('is-tilting');
        plane.style.setProperty('--tilt-x', `${-y * 5}deg`);
        plane.style.setProperty('--tilt-y', `${x * 7}deg`);
      });
    });
    plane.addEventListener('pointerleave', () => {
      if (frame) cancelAnimationFrame(frame);
      plane.classList.remove('is-tilting');
      plane.style.removeProperty('--tilt-x');
      plane.style.removeProperty('--tilt-y');
    });
  });
}

// La posición en el atlas conserva contexto al recorrer las siete láminas.
const atlasSections = Array.from(document.querySelectorAll('main section[id]'));
const atlasLinks = Array.from(document.querySelectorAll('.plate-index a'));
let navigationFrame = null;
const updateAtlasPosition = () => {
  const range = document.documentElement.scrollHeight - window.innerHeight;
  document.documentElement.style.setProperty('--read-progress', String(range > 0 ? Math.min(1, window.scrollY / range) : 0));
  const active = atlasSections.reduce((current, section) => (
    section.getBoundingClientRect().top <= window.innerHeight * 0.35 ? section : current
  ), atlasSections[0]);
  atlasLinks.forEach((link) => {
    if (active && link.hash === `#${active.id}`) link.setAttribute('aria-current', 'location');
    else link.removeAttribute('aria-current');
  });
  navigationFrame = null;
};
window.addEventListener('scroll', () => {
  if (!navigationFrame) navigationFrame = requestAnimationFrame(updateAtlasPosition);
}, { passive: true });
window.addEventListener('resize', updateAtlasPosition);
updateAtlasPosition();

// --- Validaciones para el Formulario de Testimonios ------------------------
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formTestimonio');
  if (!form) return;

  const nombreInput = document.getElementById('nombre');
  const mensajeInput = document.getElementById('mensaje');
  const errorPrintout = form.querySelector('[data-printout-error]');
  const errorText = form.querySelector('[data-error-text]');

  const setFieldError = (input, message) => {
    const field = input.closest('.field');
    const slot = field ? field.querySelector('.field__error') : null;
    if (!field || !slot) return;
    if (message) {
      field.classList.add('is-invalid');
      slot.textContent = message;
      input.setAttribute('aria-invalid', 'true');
    } else {
      field.classList.remove('is-invalid');
      slot.textContent = '';
      input.removeAttribute('aria-invalid');
    }
  };

  const validate = () => {
    const errores = {};
    const nombre = nombreInput.value.trim();
    const mensaje = mensajeInput.value.trim();

    // Validar nombre
    if (!nombre) {
      errores.nombre = 'El nombre es obligatorio.';
    } else if (!/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) {
      errores.nombre = 'El nombre solo debe contener letras.';
    } else if (nombre.length > 100) {
      errores.nombre = 'El nombre no puede superar los 100 caracteres.';
    }

    // Validar mensaje
    if (!mensaje) {
      errores.mensaje = 'El mensaje no puede estar vacío.';
    } else if (mensaje.length > 600) {
      errores.mensaje = 'El mensaje no puede superar los 600 caracteres.';
    }

    setFieldError(nombreInput, errores.nombre || '');
    setFieldError(mensajeInput, errores.mensaje || '');

    return errores;
  };

  form.addEventListener('submit', (event) => {
    const errores = validate();

    if (Object.keys(errores).length > 0) {
      event.preventDefault();
      if (errorPrintout) {
        errorPrintout.hidden = false;
        if (errorText) {
          errorText.textContent = 'Revisa los campos marcados antes de enviar.';
        }
      }
      const firstInvalid = form.querySelector('.field.is-invalid input, .field.is-invalid textarea');
      if (firstInvalid) firstInvalid.focus();
      return;
    }

    if (errorPrintout) errorPrintout.hidden = true;
  });

  nombreInput.addEventListener('blur', () => validate());
  mensajeInput.addEventListener('blur', () => validate());

  if (errorPrintout && !errorPrintout.hidden) {
    errorPrintout.scrollIntoView({ block: 'center', behavior: prefersReducedMotion ? 'auto' : 'smooth' });
  }
});

// Oculta el mensaje de éxito automáticamente después de 6 segundos
document.addEventListener('DOMContentLoaded', () => {
  const successMsg = document.querySelector('.printout--ok:not([hidden])');
  if (!successMsg) return;

  window.setTimeout(() => {
    successMsg.style.transition = 'opacity 0.5s ease';
    successMsg.style.opacity = '0';
    window.setTimeout(() => successMsg.setAttribute('hidden', ''), 500);
  }, 6000);
});
