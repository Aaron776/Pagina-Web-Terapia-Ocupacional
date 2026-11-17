// Vida Plena — navegación, fotografías y experiencias.
document.documentElement.classList.replace('no-js', 'js');
const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
const reducedMotion = () => motionQuery.matches;

// Menú móvil: conserva enlaces accesibles sin JavaScript.
const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#site-navigation');
const closeMenu = () => {
  menuButton?.setAttribute('aria-expanded', 'false');
  navigation?.classList.remove('is-open');
};
menuButton?.addEventListener('click', () => {
  const open = menuButton.getAttribute('aria-expanded') !== 'true';
  menuButton.setAttribute('aria-expanded', String(open));
  navigation?.classList.toggle('is-open', open);
});
navigation?.addEventListener('click', (event) => {
  if (event.target.closest('a')) closeMenu();
});
document.addEventListener('keydown', (event) => {
  if (event.key === 'Escape' && menuButton?.getAttribute('aria-expanded') === 'true') {
    closeMenu();
    menuButton.focus();
  }
});
window.matchMedia('(min-width: 761px)').addEventListener('change', closeMenu);

// Los accesos por etapa abren el servicio correspondiente antes de navegar.
const openService = (hash) => {
  const service = document.getElementById(hash.replace(/^#/, ''));
  if (service?.matches('details.service')) service.open = true;
};
document.querySelectorAll('a[href^="#servicio-"]').forEach((link) => {
  link.addEventListener('click', () => openService(link.hash));
});
window.addEventListener('hashchange', () => openService(location.hash));
openService(location.hash);

// Carruseles nativos: la perspectiva afecta al contenido, nunca al ancho del paso.
document.querySelectorAll('[data-slider]').forEach((slider) => {
  const track = slider.querySelector('[data-track]');
  if (!track) return;
  const slides = Array.from(track.children);
  const dots = Array.from(slider.querySelectorAll('[data-slider-dot]'));
  const prev = slider.querySelector('[data-slider-prev]');
  const next = slider.querySelector('[data-slider-next]');
  const counter = slider.querySelector('[data-slider-counter]');
  let activeIndex = 0;
  let frame = null;
  const step = () => track.clientWidth;
  const current = () => Math.max(0, Math.min(slides.length - 1, Math.round(track.scrollLeft / (step() || 1))));
  const goTo = (index, instant = false) => {
    activeIndex = Math.max(0, Math.min(slides.length - 1, index));
    track.scrollTo({ left: activeIndex * step(), behavior: instant || reducedMotion() ? 'instant' : 'smooth' });
  };
  const sync = () => {
    const index = current();
    activeIndex = index;
    const position = track.scrollLeft / (step() || 1);
    slides.forEach((slide, i) => {
      const distance = reducedMotion() ? 0 : Math.min(1, Math.abs(i - position));
      slide.style.setProperty('--slide-angle', `${reducedMotion() ? 0 : Math.max(-1, Math.min(1, i - position)) * -7}deg`);
      slide.style.setProperty('--slide-scale', String(1 - distance * 0.035));
      slide.style.setProperty('--slide-opacity', String(1 - distance * 0.15));
    });
    dots.forEach((dot, i) => {
      dot.classList.toggle('is-active', i === index);
      if (i === index) dot.setAttribute('aria-current', 'true');
      else dot.removeAttribute('aria-current');
    });
    if (prev) prev.disabled = index === 0;
    if (next) next.disabled = index === slides.length - 1;
    if (counter) {
      const text = `${String(index + 1).padStart(2, '0')} / ${String(slides.length).padStart(2, '0')}`;
      if (counter.textContent !== text) counter.textContent = text;
    }
    frame = null;
  };
  track.addEventListener('scroll', () => {
    if (!frame) frame = requestAnimationFrame(sync);
  }, { passive: true });
  prev?.addEventListener('click', () => goTo(current() - 1));
  next?.addEventListener('click', () => goTo(current() + 1));
  dots.forEach((dot) => dot.addEventListener('click', () => goTo(Number(dot.dataset.sliderDot))));
  track.addEventListener('keydown', (event) => {
    const destinations = { ArrowRight: current() + 1, ArrowLeft: current() - 1, Home: 0, End: slides.length - 1 };
    if (Object.hasOwn(destinations, event.key)) {
      event.preventDefault();
      goTo(destinations[event.key]);
    }
  });
  if ('ResizeObserver' in window) {
    new ResizeObserver(() => goTo(activeIndex, true)).observe(track);
  } else {
    window.addEventListener('resize', () => goTo(activeIndex, true));
  }
  motionQuery.addEventListener('change', sync);
  if (slides.length < 2) slider.classList.add('is-single');
  sync();
});

// Un gesto suave de profundidad para las fotografías; nunca mueve el texto.
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');
document.querySelectorAll('[data-tilt]').forEach((plane) => {
  let frame = null;
  const reset = () => {
    if (frame) cancelAnimationFrame(frame);
    plane.style.removeProperty('--tilt-x');
    plane.style.removeProperty('--tilt-y');
  };
  plane.addEventListener('pointermove', (event) => {
    if (reducedMotion() || !finePointer.matches) return;
    if (frame) cancelAnimationFrame(frame);
    frame = requestAnimationFrame(() => {
      const r = plane.getBoundingClientRect();
      const x = Math.max(-1, Math.min(1, (event.clientX - r.left) / r.width * 2 - 1));
      const y = Math.max(-1, Math.min(1, (event.clientY - r.top) / r.height * 2 - 1));
      plane.style.setProperty('--tilt-x', `${-y * 3}deg`);
      plane.style.setProperty('--tilt-y', `${x * 4}deg`);
    });
  });
  plane.addEventListener('pointerleave', reset);
  motionQuery.addEventListener('change', reset);
  finePointer.addEventListener('change', reset);
});

const sections = Array.from(document.querySelectorAll('main section[id]'));
const navLinks = Array.from(document.querySelectorAll('.plate-index a'));
let navFrame = null;
const updateNavigation = () => {
  const active = sections.reduce((current, section) => section.getBoundingClientRect().top <= window.innerHeight * 0.35 ? section : current, sections[0]);
  navLinks.forEach((link) => {
    if (active && link.hash === `#${active.id}`) link.setAttribute('aria-current', 'location');
    else link.removeAttribute('aria-current');
  });
  navFrame = null;
};
window.addEventListener('scroll', () => {
  if (!navFrame) navFrame = requestAnimationFrame(updateNavigation);
}, { passive: true });
window.addEventListener('resize', updateNavigation);
updateNavigation();

// Misma validación de testimonios: nombre de hasta 100, experiencia de hasta 600.
const form = document.getElementById('formTestimonio');
if (form) {
  const nombreInput = document.getElementById('nombre');
  const mensajeInput = document.getElementById('mensaje');
  const errorPrintout = form.querySelector('[data-printout-error]');
  const errorText = form.querySelector('[data-error-text]');
  const setFieldError = (input, message) => {
    const field = input.closest('.field');
    const slot = field?.querySelector('.field__error');
    if (!field || !slot) return;
    field.classList.toggle('is-invalid', Boolean(message));
    slot.textContent = message;
    if (message) input.setAttribute('aria-invalid', 'true');
    else input.removeAttribute('aria-invalid');
  };
  const validate = () => {
    const errores = {};
    const nombre = nombreInput.value.trim();
    const mensaje = mensajeInput.value.trim();
    if (!nombre) errores.nombre = 'El nombre es obligatorio.';
    else if (!/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) errores.nombre = 'El nombre solo debe contener letras.';
    else if (nombre.length > 100) errores.nombre = 'El nombre no puede superar los 100 caracteres.';
    if (!mensaje) errores.mensaje = 'El mensaje no puede estar vacío.';
    else if (mensaje.length > 600) errores.mensaje = 'El mensaje no puede superar los 600 caracteres.';
    setFieldError(nombreInput, errores.nombre || '');
    setFieldError(mensajeInput, errores.mensaje || '');
    return errores;
  };
  form.addEventListener('submit', (event) => {
    const errores = validate();
    if (Object.keys(errores).length > 0) {
      event.preventDefault();
      if (errorPrintout) errorPrintout.hidden = false;
      if (errorText) errorText.textContent = 'Revisa los campos marcados antes de enviar.';
      form.querySelector('.field.is-invalid input, .field.is-invalid textarea')?.focus();
      return;
    }
    if (errorPrintout) errorPrintout.hidden = true;
  });
  nombreInput.addEventListener('blur', validate);
  mensajeInput.addEventListener('blur', validate);
}
const successMsg = document.querySelector('.printout--ok:not([hidden])');
if (successMsg) window.setTimeout(() => { successMsg.hidden = true; }, 6000);
