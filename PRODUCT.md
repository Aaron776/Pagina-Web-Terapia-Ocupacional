# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Personas de todas las edades (niños, adultos y personas mayores) que buscan terapia ocupacional para sí mismas o para un familiar, junto con sus familias. Situación: necesitan entender rápido qué ofrece el servicio, confiar en la terapeuta y contactar sin fricción (WhatsApp o formulario de testimonios).

## Product Purpose

Sitio vitrina de una práctica de terapia ocupacional ("Vida Plena") que presenta al terapeuta, sus servicios y su trabajo, recoge testimonios reales de clientes y convierte visitas en conversaciones de contacto. Éxito = el visitante comprende la oferta en el primer scroll y contacta por WhatsApp o deja su testimonio.

## Positioning

Acompañamiento personalizado e integral para todas las edades —desde intervención infantil hasta rehabilitación adulto-mayor— con un trato cercano y programas individualizados, no un protocolo genérico.

## Operating Context

- Página única (`index.php`) servida en PHP + MySQL (XAMPP), formulario de testimonios con validación en servidor (PDO) y en cliente.
- Contacto principal: WhatsApp flotante (wa.me/593987384545); teléfono, correo y dirección ficticios de ejemplo en la sección de contacto.
- Contenido bilingüe no aplica: sitio en español.

## Capabilities and Constraints

- Secciones existentes a conservar: Quién soy, Servicios (3), Galería, Testimonios (CRUD de creación vía formulario + listado desde BD), Contacto, footer.
- Estructura ampliable aprobada por el usuario: hero de impacto y nuevas secciones de jerarquía; las secciones existentes y el formulario se mantienen.
- Copy mejorable aprobado: reescritura profesional de textos conservando significado y datos (corregir p. ej. el "En Vida Plena" duplicado).
- Sin framework ni build step: HTML/CSS/JS vanilla + PHP; se respetará este stack.
- Testimonios: solo los reales de la BD; no inventar nombres ni citas.

## Brand Commitments

- Nombre: "Vida Plena - Terapia Ocupacional" (obligatorio conservar).
- Logo: `img/logo.jpg` (obligatorio conservar como activo).
- Datos de contacto y número de WhatsApp: conservar tal cual.
- Dirección visual: aprobado **rediseño total** — paleta, tipografía y estilo se reinventan con dirección propia moderna con efectos 3D; la identidad azul incumplente no es vinculante.

## Evidence on Hand

- Imágenes reales: `img/logo.jpg`, `img/yo.jpg` (foto de perfil), `img/trabajo.jpg` (galería; actualmente repetida 4 veces).
- Testimonios reales desde la tabla `testimonios` de la BD.
- No hay testimonios, certificaciones ni datos clínicos inventados en el repo; el trabajo futuro no debe fabricarlos (el formulario permite añadir reales).

## Product Principles

1. Cercanía con profesionalismo: tono cálido pero clínico-confiable.
2. El visitante debe entender la oferta y encontrar el contacto en pocos segundos.
3. Toda la prueba social proviene de datos reales (BD, fotos reales); nada fabricado.
4. Accesible y usable en móvil primero (audiencia amplia, incl. personas mayores).

## Accessibility & Inclusion

Requisito derivado del público (personas mayores y familias): contraste alto, jerarquía tipográfica legible, targets de toque amplios, navegación por teclado y `prefers-reduced-motion` respetado en los efectos 3D/motion.
