---
name: Vida Plena — Terapia Ocupacional
description: Atlas de Movimiento — a printed anatomical-atlas plate system for an occupational-therapy practice.
colors:
  cold-plate: "#eeeef0"
  plate-sunk: "#e5e6ea"
  plate-raised: "#f7f7f8"
  atlas-ink: "#14161b"
  ink-secondary: "#4c515b"
  ink-tertiary: "#5f646e"
  rule-hairline: "rgba(20, 22, 27, 0.16)"
  rule-strong: "rgba(20, 22, 27, 0.34)"
  rule-faint: "rgba(20, 22, 27, 0.07)"
  cobalt: "#2440db"
  cobalt-deep: "#1a2fa8"
  cobalt-wash: "rgba(36, 64, 219, 0.09)"
  vermellon: "#e8451f"
  vermellon-wash: "rgba(232, 69, 31, 0.1)"
  wood: "#d9b78c"
  wood-lit: "#eccf9f"
  wood-shade: "#a97c4e"
  ok-green: "#1f7a4d"
typography:
  display:
    fontFamily: "Bricolage Grotesque, Segoe UI, system-ui, sans-serif"
    fontSize: "clamp(2.5rem, 5.6vw, 5rem)"
    fontWeight: 700
    lineHeight: 1.06
    letterSpacing: "-0.022em"
  headline:
    fontFamily: "Bricolage Grotesque, Segoe UI, system-ui, sans-serif"
    fontSize: "clamp(1.7rem, 3.4vw, 2.6rem)"
    fontWeight: 700
    lineHeight: 1.06
    letterSpacing: "-0.022em"
  title:
    fontFamily: "Bricolage Grotesque, Segoe UI, system-ui, sans-serif"
    fontSize: "clamp(1.25rem, 2vw, 1.62rem)"
    fontWeight: 700
    lineHeight: 1.06
    letterSpacing: "-0.022em"
  body:
    fontFamily: "Bricolage Grotesque, Segoe UI, system-ui, sans-serif"
    fontSize: "clamp(1rem, 0.62vw + 0.9rem, 1.11rem)"
    fontWeight: 400
    lineHeight: 1.62
    letterSpacing: "normal"
  lede:
    fontFamily: "Bricolage Grotesque, Segoe UI, system-ui, sans-serif"
    fontSize: "clamp(1.02rem, 1.4vw, 1.16rem)"
    fontWeight: 400
    lineHeight: 1.55
  label:
    fontFamily: "Martian Mono, ui-monospace, SFMono-Regular, Consolas, monospace"
    fontSize: "0.76rem"
    fontWeight: 500
    letterSpacing: "0.08em"
rounded:
  sm: "2px"
  md: "3px"
  pill: "999px"
spacing:
  gutter: "clamp(1.25rem, 5vw, 5.5rem)"
  plate-block: "clamp(3.4rem, 8vw, 7rem)"
components:
  stamp:
    backgroundColor: "{colors.cobalt}"
    textColor: "#ffffff"
    rounded: "{rounded.md}"
    padding: "0.75rem 1.1rem"
  stamp-hover:
    backgroundColor: "{colors.cobalt-deep}"
    textColor: "#ffffff"
  stamp-ghost:
    backgroundColor: "transparent"
    textColor: "{colors.atlas-ink}"
    rounded: "{rounded.md}"
    padding: "0.75rem 1.1rem"
  tag:
    backgroundColor: "transparent"
    textColor: "{colors.ink-secondary}"
    rounded: "{rounded.sm}"
    padding: "0.3rem 0.55rem"
  field:
    backgroundColor: "{colors.cold-plate}"
    textColor: "{colors.atlas-ink}"
    rounded: "{rounded.md}"
    padding: "0.72rem 0.8rem"
  float-action:
    backgroundColor: "{colors.atlas-ink}"
    textColor: "#ffffff"
    rounded: "{rounded.md}"
    padding: "0.85rem 1.1rem 0.85rem 0.9rem"
  plate-frame:
    backgroundColor: "{colors.plate-raised}"
    textColor: "{colors.atlas-ink}"
    rounded: "0px"
    padding: "0.9rem"
  plate-index-item:
    backgroundColor: "transparent"
    textColor: "{colors.ink-secondary}"
    rounded: "0px"
    padding: "0.45rem 0.6rem"
---

# Design System: Vida Plena — Terapia Ocupacional

## Overview

**Creative North Star: "The Movement Atlas"**

The page is a printed anatomical-atlas plate, not a website. Its organizing device is the numbered *lámina* (01–07): every section is a plate with a mono caption header carrying its name and code, laid on a cold laboratory ground crossed by an SVG measurement reticle, a ruler edge, range arcs, and leader-line annotations. The offer is presented the way a movement study is presented — manikin, arc, tick, measurement — so that occupational therapy reads as instrumented and precise rather than soft.

The world is deliberately cold and clinical: a three-step laboratory plate (*cold-plate*, *plate-sunk*, *plate-raised*) with hairlines doing the work that cards and ambient shadow usually do. Three material voices carry meaning — wood in the named 3D manikin, cobalt in arcs and actions, vermellón only on the active element. All figure, arc, reticle, and pictogram geometry is authored in CSS/SVG; nothing imitates a photograph. The warm cream "wellness" ground and the rounded pastel card that the category publishes are both refused.

**Key Characteristics:**
- Cold laboratory plate in three tonal steps, structured by hairline rules rather than bordered cards and ambient shadow.
- Numbered láminas (01–07) with mono caption codes as the page's index and identity.
- Three material voices only: wood (the figure), cobalt (arcs and actions), vermellón (active element alone).
- Instrumented feel: measurement reticle, ruler, range arcs, annotation leader lines and ticks.
- CSS-authored geometry throughout; the reflection of the plate itself is a signature mechanism.

## Colors

A cold, near-monochrome laboratory ground with a single structural blue, a single reserved warning red, and one warm material. The palette is dominated by the plate and its hairlines; color is an event, not a wash.

### Primary
- **Cobalt** (#2440db): the structural accent. Arc strokes, the range body, primary action (`.stamp`), links, focus ring, procedure numbers, `::selection`, and the active hover underline in the plate index. It is the only saturated color allowed to carry action.
- **Cobalt Deep** (#1a2fa8): the pressed/hover end of every cobalt surface (button hover fill, floating action hover).
- **Cobalt Wash** (rgba(36, 64, 219, 0.09)): the faintest cobalt tint for incidental fills.

### Secondary
- **Vermellón** (#e8451f): reserved strictly for the *active* element — the live point in a procedure diagram (`.procedure__dot`) and invalid form state. Never decorative, never a background.
- **Vermellón Wash** (rgba(232, 69, 31, 0.1)): the invalid-field background.
- **Ok Green** (#1f7a4d): the single success/confirmation tone in the form printout.

### Tertiary
- **Wood** (#d9b78c): the modeled material of the manikin, applied as a shaded gradient across every limb.
- **Wood Lit** (#eccf9f) and **Wood Shade** (#a97c4e): the highlight and shadow stops of the wood gradient and the joint radial.

### Neutral
- **Cold Plate** (#eeeef0): the page and default surface ground.
- **Plate Sunk** (#e5e6ea): recessed surfaces — footer, sheet aside, scrollbar track.
- **Plate Raised** (#f7f7f8): raised surfaces — specimen, sheet frame, entry form, contact cells.
- **Atlas Ink** (#14161b): body and heading text, the floating action ground, the darkest figure marks.
- **Ink Secondary** (#4c515b): prose and secondary labels.
- **Ink Tertiary** (#5f646e): captions, codes, hints, muted mono.
- **Rule Hairline** (rgba(20, 22, 27, 0.16)): the default 1px divider.
- **Rule Strong** (rgba(20, 22, 27, 0.34)): emphasized dividers, input borders, plate frames.
- **Rule Faint** (rgba(20, 22, 27, 0.07)): the measurement reticle and grid lines.

### Named Rules
**The Active-Only Vermellón Rule.** Vermellón (#e8451f) appears only on the element that is active or in error. Its entire value is scarcity; if it is not marking the live point, it does not appear.

**The Cold-Plate Rule.** The ground is a cold laboratory plate (#eeeef0) with three tonal steps. The warm cream/paper ground typical of wellness pages is refused — the world is instrumented, not cozy.

## Typography

**Display Font:** Bricolage Grotesque (with Segoe UI, system-ui, sans-serif)
**Body Font:** Bricolage Grotesque
**Label/Mono Font:** Martian Mono (with ui-monospace, SFMono-Regular, Consolas, monospace)

**Character:** A single grotesque carries all language — headings, lede, prose — with optical-size variation from a 5rem display down to a 1rem body. Martian Mono is reserved for the machine voice: plate codes, figures, dates, tags, and stamped labels. The pairing reads as a research plate: one humanist voice and one unblinking technical voice.

### Hierarchy
- **Display** (700, clamp(2.5rem, 5.6vw, 5rem), 1.06): the hero headline only, balanced text, tight -0.022em tracking.
- **Headline** (700, clamp(1.7rem, 3.4vw, 2.6rem), 1.06): section lámina titles in the caption bar.
- **Title** (700, clamp(1.25rem, 2vw, 1.62rem), 1.06): service procedure names; step titles sit smaller at 1.16rem.
- **Body** (400, clamp(1rem, 0.62vw + 0.9rem, 1.11rem), 1.62): running prose; secondary prose uses Ink Secondary.
- **Lede** (400, clamp(1.02rem, 1.4vw, 1.16rem), 1.55): the plate lead lines.
- **Label** (Martian Mono, 500, 0.76rem, uppercase, 0.08em tracking): plate codes, figure captions, tags, dates, stamped button text.

### Named Rules
**The Two-Voice Rule.** Bricolage Grotesque speaks; Martian Mono only codes, counts, numbers, and stamps. Mono never sets running prose, and the grotesque never sets a plate code.

**The Micro Floor Rule.** No functional text falls below 0.76rem (~12px) — the `--micro` floor the build honors for captions, tags, and hints.

## Layout

Every section is a plate capped at 1180px (`--plate-w`), centered, with a shared gutter of `clamp(1.25rem, 5vw, 5.5rem)` and vertical padding of `clamp(3.4rem, 8vw, 7rem)`. Plates are separated by a single hairline top border; the section header is a caption bar (`justify-content: space-between`) with the title left and a mono code block right, underlined with Rule Strong.

Within plates, content is a small set of asymmetric two-column grids that collapse to one column. The cover uses 1.44fr / 1fr (prose vs figure); portrait 0.8fr / 1.2fr; procedures 0.72fr / 1.28fr; contact sheet 1.55fr / 1fr; records 1.15fr / 1fr. Three-up structures (the cover legend, the step sequence, the contact grid) are built as `1fr` cells separated by a 1px `Rule` background showing through 1px gaps.

**Responsive:** columns collapse to a single column at 1024px; the plate index wraps below the brand at 860px and the sequence becomes a stacked list with a left rule; the legend and contact grid stack at 560px; the floating action sheds its label and becomes a pill at 860px.

### Named Rules
**The Numbered-Lámina Rule.** Every section is a numbered plate with a mono caption code, and those numbers are the navigation. New sections extend the plate series (08, 09…), they do not become unnumbered blocks.

**The Measure-Band Rule.** Running body prose occupies roughly 65–72ch. The hero lede (a 58ch column-bound measure) and the three-up steps (39ch) are declared column-bound deviations of their containers, not a global maximum — do not read them as a house line-length rule.

## Elevation & Depth

Depth is printed, not lifted. Surfaces are flat at rest; there are no ambient card shadows. Layering is tonal (Plate Sunk / Cold Plate / Plate Raised) and drawn with hairlines, and true depth is reserved for two things: modeled material in the figure (inset wood shading and joint drop) and state feedback on interactive elements (a button lifting 1px on hover, the floating action casting a single downward shadow off the plate). The scene realizes depth structurally through CSS 3D — the manikin, arc, ghost numeral, and printed annotations each sit on their own z-plane and shift by different amounts, and the figure's own reflection returns from the plate below.

### Shadow Vocabulary
- **Action hover lift** (`box-shadow: 0 8px 18px -10px rgba(26, 47, 168, 0.75)`): the stamp button's cobalt glow on hover.
- **Floating action** (`box-shadow: 0 12px 26px -14px rgba(20, 22, 27, 0.85)`): the only persistent shadow, under the WhatsApp action to lift it off the plate.
- **Wood inset** (`box-shadow: inset -0.35em -0.4em 0.9em rgba(90, 58, 28, 0.28)`): the modeled side-shadow on each manikin limb.
- **Joint drop** (`box-shadow: 0 0.2em 0.5em rgba(90, 58, 28, 0.3)`): the small contact shadow under each wooden joint.

### Named Rules
**The Flat-Plate Rule.** Surfaces are flat at rest. Shadow appears only as a response to state (hover lift, focus, the floating action) or as modeled material inside the figure — never as ambient elevation on cards.

**The Plate-Reflection Rule.** The figure and its arc are returned by the plate below as a mirrored, clipped, blurred reflection (`.fig-mirror`, opacity 0.3, `scaleY(-1)` with a masked falloff). This is a signature mechanism of the world and is expected on the hero figure; it is never duplicated as a generic content treatment.

## Shapes

The form language is the technical plate: near-square corners and near-invisible radii. Interactive and surface corners are 2–4px (`.tag` and focus ring at 2px, the global `--radius` at 3px); plate frames, specimen boxes, entry forms, and contact cells are true rectangles with hairline borders. Measurement marks are the recurring geometry: 1px rules, ticks, dashed fan lines, leader lines with a small circular tick, and a 11px rotated-square step mark. Only the figure departs into organic form — wooden limbs and joints are pill and ellipse radii, and the brand logo is a 42px circle.

### Named Rules
**The Two-to-Four Rule.** Corners are 2–4px. Interactive and flat surfaces never exceed it, never square off to 0 where the world uses 3px, and only the modeled figure, the logo, and the mobile floating action may go fully round.

## Components

### Buttons
- **Shape:** rectangular, `--radius` (3px), 1px border matching fill.
- **Primary (`stamp`):** cobalt fill, white mono uppercase text at 0.76rem, 0.06em tracking, padding 0.75rem 1.1rem, with a 7px `currentColor` dot before the label. The label reads as a stamped plate instruction ("Escribir por WhatsApp", "Enviar testimonio").
- **Hover / Focus:** fill and border shift to Cobalt Deep and the button lifts 1px with the cobalt glow; focus-visible draws a 2px cobalt outline at 3px offset.
- **Ghost (`stamp--ghost`):** transparent fill, Atlas Ink text, Rule Strong border; hovers to a solid Ink fill with white text and no shadow.

### Chips (if used)
- **Style:** the `.tag` — mono uppercase, Ink Secondary text, 1px Rule Strong border, 2px radius, transparent fill, 0.3rem 0.55rem padding.
- **State:** static metadata only (service facets such as "Memoria", "Motricidad"); there is no selected/filter state in the build.

### Cards / Containers
- **Corner Style:** 0px — plates are true rectangles.
- **Background:** Plate Raised for raised content (specimen, sheet frame, entry, contact cell); Plate Sunk for recessed context (sheet aside, footer).
- **Shadow Strategy:** none; see Elevation & Depth (Flat-Plate Rule).
- **Border:** 1px Rule Strong on frames; 1px Rule for internal dividers.
- **Internal Padding:** 1.1rem for specimen frames, 0.9rem for sheet frames, `clamp(1.3rem, 3vw, 2rem)` for entry and contact cells.

### Inputs / Fields
- **Style:** full-width, Cold Plate background, 1px Rule Strong border, 3px radius, 0.72rem 0.8rem padding; label is mono uppercase 0.76rem above the field; a mono hint sits below.
- **Focus:** border shifts to Cobalt and background clears to white (`outline: none`, border-color change).
- **Error:** the `.field.is-invalid` state sets the border to Vermellón and the background to Vermellón Wash; the message prints in-flow in a dark red mono line, never as floating chrome.

### Navigation
- **Style:** the header is a sticky plate-index of numbered lámina links (`01 Quién soy` … `07 Contacto`), each pairing a mono `--micro` number with a 0.9rem/500 label, separated by a 2px transparent bottom border that turns cobalt on hover/focus; the number turns cobalt with it.
- **Mobile:** at 860px the index wraps to its own full-width row under the brand with a hairline top border; at 560px the header CTA hides its text and keeps only its dot.

### Signature Components
- **Plate caption bar (`plate__caption`):** the section header — title left (headline size), a right-aligned mono code block whose strong line is the lámina number and whose second line is a category ("Retrato · recorte 4:3"), closed by a Rule Strong underline. It is the identity of every section.
- **Annotated scene (`fig-scene`):** the hero's CSS-3D assembly — wooden articulated manikin, cobalt range arc that draws on reveal, dashed range fan, ghost plate numeral, mono annotation leader lines, a floor shadow, and the plate reflection. Layers parallax independently on pointer move and flatten to static when reduced motion is requested.
- **Scroll-snap carousel (`slider`):** a shared chassis — an overflow-clipped, scrollbar-hidden track of full-width slides (`slider__slide`) advanced by bordered ghost buttons, with keyboard (← → Home End) and native swipe. It carries two bearers: the **photographic registry** (Lámina 05) shows a raised plate per 3:2 crop (`sheet-frame__media`) with the caption inside the frame and tick dots, where detail slides re-view the same photograph at scale via `--zoom` / `--ox` / `--oy`; the **testimonios registry** (Lámina 06) shows one record card per slide (`record`) with a mono `nn / NN` counter instead of ticks. Controls collapse to nothing when only one slide is present.

## Do's and Don'ts

### Do:
- **Do** keep the ground on the cold plate (#eeeef0) and reach for the three tonal steps for layering; treat the measurement reticle as structure, not decoration.
- **Do** number every section as a lámina with a mono caption code (Two-to-Four Rule corners, 2–4px).
- **Do** let cobalt be the only action color; reserve vermellón (#e8451f) for the single active or invalid element.
- **Do** author figures, arcs, ticks, and pictograms as CSS/SVG geometry with 1px hairlines, and keep body prose within ~65–72ch.
- **Do** honor `prefers-reduced-motion` — reveal, arc draw-on, and pointer parallax all flatten and the reflection stays put.

### Don't:
- **Don't** use warm cream or paper grounds, or reintroduce the pastel rounded-card wellness look the world rejects.
- **Don't** add ambient card shadows or lift surfaces that are not responding to state (Flat-Plate Rule).
- **Don't** use vermellón as a fill, background, or decoration — it marks only the live point.
- **Don't** set running prose in Martian Mono, or drop any functional label below 0.76rem.
- **Don't** exceed 4px on a flat interactive corner, and don't square those corners to 0.
