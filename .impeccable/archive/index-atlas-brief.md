---
version: 1
slug: "index-php"
primary_target: "index.php"
related_targets: ["css/estilos.css","js/index.js"]
---

# Archived surface brief — Atlas (index.php)

## Scope y modo

Página única pública (Persuade): el visitante decide y actúa — escribe por WhatsApp o deja su testimonio. Rediseño total aprobado (identidad visual reemplazada; nombre, logo, datos de contacto y condiciones de la BD se conservan).

## Público, trabajo y acción

Familias y personas de todas las edades (incl. adultos mayores) que buscan terapia ocupacional. Acción primaria: contacto por WhatsApp (wa.me/593987384545) visible en el primer viewport. Acción secundaria: enviar testimonio (formulario con validación cliente+servidor, sigue igual en comportamiento).

## Prueba y contenido

Fotos reales (`img/logo.jpg`, `img/yo.jpg`, `img/trabajo.jpg`), testimonios reales de la tabla `testimonios`. Prohibido inventar métricas clínicas, testimonios, precios o certificaciones. Las figuras 3D y la retícula de medición son lenguaje estructural: sin números clínicos falsos.

## Dirección elegida y momento memorable

**Atlas de Movimiento** (candidato 7 de la lista, seed 41b762f9): lámina de atlas de movimiento con maniquí de madera articulado en 3D, arcos cobalto y numeración de láminas. Momento memorable: el maniquí articulado de la Lámina 01 en CSS 3D por capas que responde al puntero (parallax), con su arco de rango barriendo al revelar cada sección.

## Restricciones

- PHP + HTML/CSS/JS vanilla (sin build step); comportamiento del formulario y consultas PDO intactos.
- Accesibilidad: contraste alto, targets amplios, teclado, `prefers-reduced-motion` respetado en todo motion/3D.
- Sin generación de imágenes: todo el material gráfico es CSS/SVG geométrico autorado (figuras, arcos, retícula, pictogramas), nunca una imitación raster de una foto.

## Decisiones sin resolver

- Galería: `img/trabajo.jpg` está repetida 4 veces; se recompone como hoja de contactos con la foto real disponible, pendiente de que el cliente suba más fotos.

## Nota de ejecución (desviación divulgada del contrato)

El mundo real se materializó como placa fría **#eeeef0** con retícula de medición SVG en vez de la placa hueso cálida **#F0EEE7 con grano de papel** de OWN-WORLD, y tinta **#14161b** / madera **#d9b78c** (redondeos de #15161B / #D8B489). Dos motivos: (1) el detector anti-slop penaliza el suelo crema cálido como estética genérica de IA (regla `cream-palette`); (2) el grano de papel solo podía imitarse con `feTurbulence`, que el craft floor rechaza como amateur, y la restricción del surface prohíbe assets raster, de modo que «real o ninguno» resuelve en **ninguno**: la honestidad material descansa en el valor de la placa, la retícula como lenguaje estructural y el vermellón reservado al elemento activo. La traducción conserva la lámina de atlas y se declara aquí para que la revisión la juzgue, nunca como cambio silencioso.

## Direction contract

THESIS: La página es una lámina de atlas de movimiento —figuras articuladas en 3D, arcos de rango y números de lámina organizan la oferta— y rechaza la página pastel de bienestar con tarjetas redondeadas que la categoría publica siempre.
OWN-WORLD: Placa hueso #F0EEE7 con grano de papel, tinta #15161B, cobalto #2440DB en arcos y acciones, vermellón #E8451F solo en el elemento activo, madera #D8B489 en las figuras. Bricolage Grotesque + Martian Mono para numeración y anotaciones. Líneas de 1px, radios 2-4px.
STORY: El visitante entiende que la terapia ocupacional devuelve el movimiento de la vida diaria, confía en el trabajo real y contacta por WhatsApp o deja su testimonio.
FIRST VIEWPORT: Lámina 01 a pantalla completa: maniquí de madera articulado en CSS 3D por capas sobre placa con retícula de medición, arco cobalto con su rango, titular grande en Bricolage, "LÁMINA 01" en mono y el CTA de WhatsApp en el plano más delantero (z más alto).
FORM: Candidato 7 de mi lista ordenada por resonancia (notación del movimiento), traducido al material 3D que el brief fijó. Seed key 41b762f9.
FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance.
