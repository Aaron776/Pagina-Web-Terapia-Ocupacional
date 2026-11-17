# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Personas de todas las edades (niños, adultos y personas mayores) que buscan terapia ocupacional para sí mismas o para un familiar, junto con sus familias. Situación: necesitan entender rápido qué ofrece el servicio, confiar en la terapeuta y contactar sin fricción (WhatsApp o formulario de testimonios).

## Product Purpose

Sitio vitrina de una práctica de terapia ocupacional ("Vida Plena") que presenta al terapeuta, sus servicios y su trabajo, permite compartir experiencias mediante un formulario y convierte visitas en conversaciones de contacto. La BD conserva entradas existentes, incluidas muestras de demostración no verificadas independientemente. Éxito = el visitante comprende la oferta en el primer scroll y contacta por WhatsApp o deja su testimonio.

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
- Testimonios: conservar las entradas existentes de la BD, que incluyen muestras de demostración insertadas anteriormente por instrucción explícita del usuario como ejemplos realistas sin marcar. Su presencia en la BD no acredita autenticidad. No inventar nuevos nombres, citas ni afirmaciones sin evidencia aportada por el usuario.

## Brand Commitments

- Nombre: "Vida Plena - Terapia Ocupacional" (obligatorio conservar).
- Logo: `img/logo.jpg` (obligatorio conservar como activo).
- Datos de contacto y número de WhatsApp: conservar tal cual.
- Dirección visual: aprobado **rediseño total** y delegada la selección tras investigar referencias: **Espacio para avanzar**, blanco, lavanda, violeta y albaricoque, Figtree y fotografía centrada en las personas. Profundidad sutil en fotos y carruseles con alternativa de movimiento reducido; el mundo Atlas anterior está archivado y no es vinculante.

## Evidence on Hand

- Activos fotográficos preexistentes: `img/logo.jpg`, `img/yo.jpg` (selfie de perfil) e `img/trabajo.jpg` (474 × 314 px; hero y galería con tres vistas de la misma toma, incluidos dos recortes identificados). No se generaron imágenes ni se verificaron independientemente sus licencias; los sidecars registran esa procedencia.
- Entradas de la tabla `testimonios`, incluidas muestras de demostración preexistentes; no se han verificado independientemente como experiencias auténticas.
- Este rediseño no fabricó ni verificó entradas de la BD. El trabajo futuro no debe inventar nuevos testimonios, certificaciones ni datos clínicos sin evidencia aportada por el usuario; el formulario permite compartir experiencias.

## Product Principles

1. Cercanía con profesionalismo: tono cálido pero clínico-confiable.
2. El visitante debe entender la oferta y encontrar el contacto en pocos segundos.
3. Distinguir datos existentes de evidencia verificada: una entrada en la BD no prueba autenticidad. No añadir nueva prueba social ni afirmaciones sin evidencia aportada por el usuario.
4. Accesible y usable en móvil primero (audiencia amplia, incl. personas mayores).

## Accessibility & Inclusion

Requisito derivado del público (personas mayores y familias): contraste alto, jerarquía tipográfica legible, targets de toque amplios, navegación por teclado y `prefers-reduced-motion` respetado en los efectos 3D/motion.
