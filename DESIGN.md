---
name: MassLimo Connect
description: Contemporary Massachusetts mobility editorial with precise airport-wayfinding cues.
colors:
  signal-cobalt: "#2458ff"
  operational-ink: "#101114"
  warm-paper: "#f4f4ef"
  header-paper: "#f8f8f4"
  structural-line: "#d7d8d1"
  body-gray: "#55575d"
  inverse-body: "#b8bac1"
  cobalt-tint: "#a9beff"
  white: "#ffffff"
typography:
  display:
    fontFamily: "Instrument Sans, ui-sans-serif, sans-serif"
    fontSize: "clamp(4rem, 7.5vw, 6rem)"
    fontWeight: 500
    lineHeight: 0.91
    letterSpacing: "-0.04em"
  headline:
    fontFamily: "Instrument Sans, ui-sans-serif, sans-serif"
    fontSize: "clamp(3rem, 5.6vw, 5.4rem)"
    fontWeight: 500
    lineHeight: 0.98
    letterSpacing: "-0.04em"
  title:
    fontFamily: "Instrument Sans, ui-sans-serif, sans-serif"
    fontSize: "clamp(1.8rem, 2.6vw, 2.8rem)"
    fontWeight: 500
    lineHeight: 1.08
    letterSpacing: "-0.035em"
  body:
    fontFamily: "Instrument Sans, ui-sans-serif, sans-serif"
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.7
  label:
    fontFamily: "Instrument Sans, ui-sans-serif, sans-serif"
    fontSize: "0.72rem"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "0.08em"
rounded:
  square: "0"
spacing:
  xs: "0.75rem"
  sm: "1rem"
  md: "1.25rem"
  lg: "2rem"
  xl: "3rem"
  section: "8rem"
components:
  button-primary:
    backgroundColor: "{colors.signal-cobalt}"
    textColor: "{colors.white}"
    typography: "{typography.label}"
    rounded: "{rounded.square}"
    padding: "1rem 1.35rem"
    height: "52px"
  button-light:
    backgroundColor: "{colors.white}"
    textColor: "{colors.operational-ink}"
    typography: "{typography.label}"
    rounded: "{rounded.square}"
    padding: "1rem 1.35rem"
    height: "52px"
  service-link:
    backgroundColor: "{colors.warm-paper}"
    textColor: "{colors.operational-ink}"
    rounded: "{rounded.square}"
    padding: "2rem 5rem 2.2rem 0"
---

# Design System: MassLimo Connect

## Overview

**Creative North Star: "The Massachusetts Departure Editorial"**

MassLimo Connect uses the visual language of contemporary airport wayfinding and mobility editorial: decisive route codes, crisp rules, large direct typography, and a single cobalt signal. It feels efficient and current while keeping the independent-referral model plain and legible.

The composition moves between warm paper editorial fields, near-black operational sections, and full-bleed transportation photography. Density is generous but disciplined. Large headlines establish confidence; compact labels, numbered steps, and regional codes turn details into navigational landmarks.

**Key Characteristics:**

- Cobalt wayfinding against warm paper and near-black fields
- Instrument Sans at every level, with scale and weight creating hierarchy
- Square controls, crisp rules, route codes, and directional arrows
- Full-bleed automotive photography presented as illustrative
- Flat editorial layering with high-contrast section changes

## Colors

The palette is restrained and infrastructural: one vivid signal color directs attention while warm and dark neutrals carry the page.

### Primary

- **Signal Cobalt:** The sole action and wayfinding accent, used for primary calls to action, service labels, route codes, announcement bands, and directional marks.

### Neutral

- **Operational Ink:** The primary dark field for process, footer, and image overlays; also the strongest text on light sections.
- **Warm Paper:** The main editorial field behind introductions, service choices, and coverage.
- **Header Paper:** A slightly brighter paper reserved for global navigation.
- **Structural Line:** Hairline separators across light editorial fields.
- **Body Gray:** Supporting copy on paper, intentionally softer than headings.
- **Inverse Body:** Supporting copy on near-black sections.
- **Cobalt Tint:** A pale cobalt used sparingly for emphasis over photography and dark fields.
- **White:** High-contrast text and secondary light actions.

### Named Rules

**The One Signal Rule.** Cobalt is the only chromatic signal; do not add competing accent colors.

**The Field Rule.** Build sections as broad paper, ink, cobalt, or photographic fields and let their contrast establish hierarchy.

## Typography

**Display Font:** Instrument Sans (with ui-sans-serif and sans-serif fallbacks)  
**Body Font:** Instrument Sans (with ui-sans-serif and sans-serif fallbacks)

**Character:** The single-family system is direct, contemporary, and transport-oriented. Expressiveness comes from dramatic scale changes, tight display tracking, and compact uppercase labels rather than a decorative display face.

### Hierarchy

- **Display:** Medium weight, tightly tracked and compressed in line height. Use for cinematic hero and closing statements.
- **Headline:** Medium weight with a compact line height. Use for major editorial section propositions.
- **Title:** Medium weight and tightly tracked. Use for service choices and process steps.
- **Body:** Regular weight with generous leading. Keep explanatory copy around 430–580px wide to preserve a brisk reading rhythm.
- **Label:** Bold, uppercase, and widely tracked. Use for categories, route codes, compact navigation signals, and numbered markers.

### Named Rules

**The Scale Carries Voice Rule.** Keep one type family and create personality through scale, spacing, and placement.

**The Label Means Something Rule.** Uppercase microtype identifies categories, places, or sequence; it is not ornamental filler.

## Layout

The system uses broad, full-width color and image fields with content aligned to a centered 1360px shell. Desktop shell gutters are 3rem beyond the viewport calculation and collapse to 1.25rem on screens at or below 800px. Editorial sections commonly use 8rem of vertical space; major closing and operational fields use 7–9rem where the content needs more air.

Two-column sections establish editorial tension rather than symmetrical cards: the introduction uses a 1.2/.8 split, coverage uses a .9/1.1 split, and service choices form a ruled two-column list. At 800px, these resolve to single-column flows, buttons stack where necessary, supporting route details may disappear, and the photographic hero changes to a bottom-up shade for text contrast.

Spacing follows a practical rhythm built from 0.75rem, 1rem, 1.25rem, 2rem, and 3rem increments. Large section intervals are deliberate and should not be filled with decorative UI.

## Elevation & Depth

The system is flat by default and uses no shadows in the approved homepage world. Depth comes from full-bleed photography, dark image shading, strong changes between paper and ink fields, and crisp one-pixel rules. Motion is limited to a 0.2-second directional-arrow shift on hover; it signals clickability without making the surface feel animated.

### Named Rules

**The Flat Editorial Rule.** Separate content with tonal fields and rules; do not lift cards or actions with shadows.

## Shapes

Controls and content containers are square. Buttons, service choices, route boards, image indexes, and the brand mark use hard corners and straight edges. One-pixel rules provide most boundaries. Small circular dots may punctuate ticker content, but circles are wayfinding punctuation rather than a component silhouette.

**The Square Control Rule.** Interactive controls use a zero radius; do not soften the system with pills or rounded cards.

## Components

### Buttons

- **Shape:** Square, compact, and substantial with a 52px minimum height.
- **Primary:** Signal cobalt with white text in photographic, paper, and dark contexts.
- **Light:** White with operational-ink text when paired with a dark or photographic field.
- **Outlined:** Transparent with a one-pixel white border for secondary action over cobalt.
- **Hover / Focus:** Preserve the flat color block. Use a visible two-pixel focus outline with clear offset; icon arrows can move diagonally by 4px over 0.2 seconds.

### Cards / Containers

- **Corner Style:** Square.
- **Background:** Service choices share the warm-paper field rather than becoming separate filled cards.
- **Shadow Strategy:** None; use one-pixel structural rules.
- **Border:** Bottom rules on every service choice, plus a center rule between desktop columns.
- **Internal Padding:** Approximately 2rem vertically, with generous trailing space for the directional arrow.

### Navigation

Global navigation sits on header paper with near-black brand text, compact medium-weight links, and a solid near-black call action. The square near-black brand mark and cobalt word accent establish identity. At 800px, desktop links and the header call action give way to a compact menu whose panel uses the same light field and a cobalt lower rule.

### Service Choice

Each choice combines a cobalt uppercase category, a large service title, brief gray explanation, and a cobalt northeast arrow. The arrow occupies the upper-right corner and shifts 4px diagonally on hover. The choice remains part of the ruled editorial list rather than becoming a floating card.

### Route Board Row

Coverage rows use a three-part wayfinding pattern: cobalt route code, strong place name, and muted regional context. Horizontal rules and a 92px minimum height create the departure-board cadence. On mobile, the contextual third column is removed and the code/name pairing remains.

## Do's and Don'ts

### Do:

- **Do** reserve cobalt for calls to action, route codes, labels, and directional information.
- **Do** alternate broad paper, ink, cobalt, and photographic fields to structure the story.
- **Do** use crisp one-pixel rules and square geometry to organize dense choices.
- **Do** keep vehicle imagery full-bleed and clearly presented as illustrative rather than owned-fleet evidence.
- **Do** reduce multi-column layouts to clear single-column sequences at the 800px breakpoint.

### Don't:

- **Don't** introduce black-and-gold luxury styling, ornamental serif typography, or limousine-brochure decoration.
- **Don't** turn service choices into rounded, shadowed software cards.
- **Don't** add secondary accent hues that compete with cobalt.
- **Don't** use pills for buttons, navigation, filters, or labels.
- **Don't** imply that MassLimo Connect owns the vehicles shown or directly provides transportation.
