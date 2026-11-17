---
name: "Vida Plena — Espacio para avanzar"
description: "Cuidado cercano, fotografía humana y espacio para la autonomía cotidiana."
colors:
  violet: "#6041a6"
  violet-deep: "#39235e"
  lavender: "#f3f0fa"
  lavender-mid: "#e4dbf5"
  peach: "#f9dfcc"
  mint: "#e4efe9"
  ink: "#2e2839"
  ink-2: "#635e6c"
  white: "#ffffff"
  rule: "#dfd9e7"
  error: "#a32e38"
  success: "#226347"
typography:
  display:
    fontFamily: "Figtree, Segoe UI, sans-serif"
    fontSize: "clamp(3rem, 5.1vw, 4.65rem)"
    fontWeight: 600
    lineHeight: 1.13
    letterSpacing: "-0.035em"
  headline:
    fontFamily: "Figtree, Segoe UI, sans-serif"
    fontSize: "clamp(2rem, 3.3vw, 3rem)"
    fontWeight: 600
    lineHeight: 1.13
    letterSpacing: "-0.035em"
  title:
    fontFamily: "Figtree, Segoe UI, sans-serif"
    fontSize: "1.4rem"
    fontWeight: 600
    lineHeight: 1.13
    letterSpacing: "-0.035em"
  body:
    fontFamily: "Figtree, Segoe UI, sans-serif"
    fontSize: "17px"
    fontWeight: 400
    lineHeight: 1.65
  action:
    fontFamily: "Figtree, Segoe UI, sans-serif"
    fontSize: "1rem"
    fontWeight: 600
    lineHeight: 1.35
rounded:
  field: "12px"
  tile: "18px"
  frame: "24px"
  pill: "999px"
spacing:
  small: "12px"
  medium: "20px"
  large: "25px"
  section: "clamp(4.5rem, 7.8vw, 7rem)"
components:
  button-primary:
    backgroundColor: "{colors.violet}"
    textColor: "{colors.white}"
    typography: "{typography.action}"
    rounded: "{rounded.pill}"
    padding: "15px 24px"
  button-primary-hover:
    backgroundColor: "{colors.violet-deep}"
    textColor: "{colors.white}"
  button-small:
    backgroundColor: "{colors.violet}"
    textColor: "{colors.white}"
    rounded: "{rounded.pill}"
    padding: "12px 20px"
  text-link:
    textColor: "{colors.violet}"
  field:
    backgroundColor: "{colors.white}"
    textColor: "{colors.ink}"
    rounded: "{rounded.field}"
    padding: "13px 16px"
  record:
    backgroundColor: "{colors.white}"
    textColor: "{colors.violet-deep}"
    rounded: "{rounded.frame}"
    padding: "38px"
---

# Design System: Vida Plena

## Overview

**Creative North Star: "Espacio para avanzar"**

A welcoming community-care editorial world: everyday people, open space and warm rounded photographic windows make care approachable. White and pale lavender carry the page; violet supplies hierarchy and action, while apricot adds human warmth.

Depth belongs to photographs and small supporting surfaces, not to the reading plane. Bounded photo tilt and spatial carousel transitions add tactility without moving body copy. The reduced-motion version retains the same content and controls without transforms or animation.

**Key Characteristics:**
- People-first existing photography.
- Generous whitespace and plain-language hierarchy.
- Rounded controls, soft photographic layers and restrained depth.
- Keyboard-accessible interactions with a static reduced-motion alternative.

Recorded from `index.php`, `css/estilos.css` and `js/index.js`, checked against `.impeccable/review/desktop.png`, `mobile.png`, `user-1000.png` and `desktop-reduced.png`. The surface-specific contract lives in `.impeccable/surfaces/index-php.md`; archived Atlas materials are not current system authority.

## Colors

Soft lavender and apricot temper a clear violet action palette, with dark plum and muted ink supporting readable copy. Frontmatter values are normative and match the stylesheet. Sidecar tonal ramps are synthesized panel previews, not additional shipped palette tokens.

### Primary
- **Violet** (`violet`): primary buttons, links, emphasis, focus outlines and selected carousel dots.
- **Deep violet** (`violet-deep`): headings, the inverted journey plane, floating contact action and button hover.

### Secondary
- **Pale lavender** (`lavender`): welcoming section planes and gallery captions.
- **Layered lavender** (`lavender-mid`): photographic backing, service icon tile and quiet text on the inverted plane.

### Tertiary
- **Apricot** (`peach`): warm backing, circular identity markers, selected service icon tile and inverted-plane emphasis.
- **Soft mint** (`mint`): complementary physical-rehabilitation icon tile, not a competing action color.

### Neutral
- **White** (`white`): page canvas, fields, quote cards and text on violet.
- **Ink** (`ink`): default copy.
- **Muted ink** (`ink-2`): descriptive copy, captions and supporting labels.
- **Quiet rule** (`rule`): separators and input/control borders.
- **Error / Success** (`error`, `success`): validation messages and submission feedback only.

### Named Rules
**The Action Stays Violet Rule.** Use violet for actionable emphasis; reserve apricot and mint for supporting material rather than competing primary actions.

## Typography

**Display Font:** Figtree (fallback: Segoe UI, sans-serif).
**Body Font:** The same Figtree stack; no second display or mono voice.

**Character:** Open, friendly sans-serif forms with compact, balanced headings and relaxed prose. The hierarchy is fluid rather than a fixed-ratio scale.

### Hierarchy
- **Display:** the frontmatter display role, semibold and tightly tracked. At widths up to (760px), the hero uses `clamp(2.8rem, 8vw, 4rem)` and a maximum line length of (14ch).
- **Headline:** the frontmatter headline role, with upright violet emphasis rather than italic styling.
- **Title:** the frontmatter title role. Service titles use (1.35rem), reducing to (1.2rem) on mobile; their explanatory line is smaller, regular and separately stacked.
- **Body:** the frontmatter body role. Lead copy uses (1.15rem); hero copy has a (47ch) measure and line height (1.7).
- **Supporting text:** contextual labels vary from (0.8rem) to (0.95rem); keep them subordinate to readable body copy.
- **Action:** semibold sentence-case controls using the frontmatter action role. Numeric carousel counters use tabular figures.

### Named Rules
**The Reading Plane Rule.** Keep headings and body copy stable; apply interactive tilt only to photographic surfaces and spatial movement only to carousel figures.

## Layout

The recurring content container is `min(1180px, calc(100% - 80px))`, centered. Section padding uses the fluid frontmatter section interval. Desktop compositions pair unequal columns rather than a uniform card grid; the process and contact details use three columns. Gaps adapt by composition, commonly (35–85px).

- Up to (1150px): navigation and paired-column gaps tighten.
- Up to (1000px): navigation wraps beneath the brand/action row; the floating WhatsApp action becomes icon-only, retaining its accessible name. Service columns and icon tiles compact without losing descriptive lines.
- Up to (760px): the container has (20px) side gutters and sections use (65px) vertical padding. Main grids and process steps become single-column, service introduction loses sticky positioning, and gallery copy precedes the photographs. The navigation becomes a toggleable two-column link list; it stays visible without JavaScript.

The header is sticky; anchor offsets account for it. Section navigation follows scroll location. The floating action remains outside the normal content flow, with extra mobile footer space to avoid competing with closing content.

## Elevation & Depth

The default is flat and tonal: pale planes, thin rules and rounded frames organize content. Small caption/message surfaces and the floating contact action receive soft violet-tinted shadows, never hard offset slabs.

### Shadow Vocabulary
- **Photo message:** `0 16px 40px -24px rgba(57, 35, 94, 0.35)`.
- **Portrait caption:** `0 14px 32px -22px rgba(57, 35, 94, 0.3)`.
- **Floating contact:** `0 8px 28px -10px rgba(57,35,94,.4)`.

Photographic backing planes may rotate gently; the hero window has an arched top. Fine-pointer tilt is bounded to (3deg) vertically and (4deg) horizontally. Carousel figures reach a (7deg) rotation, minimum scale (0.965) and opacity (0.85) between snaps. These are interactive treatments, not a requirement for every new surface.

The user-approved hero mascot is a transparent, generated matte-clay illustration of a person practicing coordination with blocks. It remains a small supporting layer beside the session photo, never a replacement for it. The web PNG is 480×480 and is displayed at 148–198px on desktop or 124px on mobile. Only fine-pointer hover moves it by 5px with a small rotation; no autonomous loop runs, and reduced motion removes the transform. It is decorative, ignores pointer events and is hidden from assistive technology. Its source prompt and generated provenance live beside the image.

## Shapes

Use full pill buttons, circular carousel arrows and identity markers, rounded fields and soft rectangular frames. The recurring radii are recorded in frontmatter; service tiles compact from (18px) to (14px) at the intermediate breakpoint.

Photographic windows can have more expressive silhouettes than controls: the hero uses large arched top corners and (24px) bottom corners, while gallery and quote containers remain rounded rectangles. Icons are inline stroked SVG, not character glyphs or icon fonts.

## Components

### Buttons and text links
Clear, approachable sentence-case actions. Primary buttons have a minimum height of (54px); the compact header variant uses (46px). Hover darkens and lifts by (2px); active returns to baseline. Arrow SVGs shift slightly on hover. Text links are underlined, violet and at least (44px) high.

All keyboard-focusable controls inherit a (3px) violet outline with (5px) offset. Reduced-motion preferences remove transitions and transforms.

### Service details
Native disclosure rows, separated by rules rather than boxed cards. Each summary contains a colored icon tile, a heading with its descriptive line **below** the title, and a CSS plus/minus indicator. The first service starts open; independent details can remain open together. Audience links open the matching service before navigating. On mobile the expanded body aligns with the full row, not an icon-offset column.

### Cards / Containers
Quote cards are white on lavender, softly rounded and shadow-free, with a generous reading area and an apricot initial marker. Their desktop padding is the frontmatter record value; on mobile it becomes (28px). The gallery combines an image frame and a lavender caption. Do not imply that separate crops are separate sessions.

### Inputs / Fields
Visible labels sit above white, bordered, rounded fields. Focus changes the border to violet in addition to the shared outline. Errors use an error-colored border and adjacent text; client validation sets `aria-invalid`, announces messages and focuses the first invalid field. Name and experience limits are (100) and (600) characters, with server-side validation retained. The textarea resizes vertically.

### Navigation
Sticky white header, logo/wordmark, plain-language links and a compact action. Hover/current links turn violet; desktop current location adds a small dot. On mobile the dot disappears and link separators aid scanning. The menu exposes `aria-expanded`, closes on selection or Escape, and returns focus to its toggle after Escape.

### Carousels
Native horizontal scroll-snap tracks, one full-width slide at a time, without autoplay. Both support arrows, Home and End, pointer/touch scrolling, boundary-disabled buttons and resize alignment. The photo carousel has current-state dots; the testimonial carousel has a live, zero-padded counter. Single-slide controls hide. Reduced motion makes scrolling instant and removes spatial effects.

### Floating contact
Deep-violet pill with an inline SVG and text on wide screens. At (1000px) and below it becomes a compact icon-only control with the same accessible name and destination. Hover lifts it by (3px).

## Do's and Don'ts

### Do:
- **Do** use violet for actionable emphasis and apricot or mint for supporting material.
- **Do** preserve readable, stationary copy while photographs and carousel figures supply subtle depth.
- **Do** retain visible focus, labeled fields, native disclosure semantics and reduced-motion alternatives.
- **Do** keep service descriptions below their headings and compact floating contact at the intermediate breakpoint.

### Don't:
- **Don't** restore the archived Atlas palette, technical grid or instrument aesthetic as current system rules.
- **Don't** present repeated photo crops as distinct sessions or database presence as independent testimonial verification.
- **Don't** add invented testimonials, clinical credentials or outcome claims without user-supplied evidence.
- **Don't** make essential navigation, content or actions depend on animation.
