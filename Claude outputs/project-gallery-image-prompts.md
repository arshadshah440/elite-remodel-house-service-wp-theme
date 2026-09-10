# Project Gallery - Before & After Image Prompts

Page: `/elite/kitchen-remodel-before-after/`
Section: Project Gallery (`gallery-projects`), repeater fields `image_before` / `image_after`

## Specs

| Item | Value |
|---|---|
| Display box | 4:3, roughly 570 px wide per photo on desktop, full width under 640 px |
| Upload at | 1400 x 1050 px (WordPress generates the `erh-compare` 900 x 675 crop) |
| Format | WebP, quality 80, target under 180 KB |
| Count | 6 (3 matched pairs) |

## Method (this is the part that matters)

Generate the **BEFORE** image first. Then feed that exact image back in as an image-to-image input for the **AFTER** prompt. Two prompts written independently give you two different kitchens, and the comparison stops meaning anything.

When you run the AFTER prompt, prepend:

> Using this exact photograph as the base, keep the same room, the same camera position and focal length, the same window and door placement, and the same wall, ceiling and floor geometry. Renovate only the finishes, cabinetry and fixtures as described below.

## Global style line (append to every prompt)

> Photorealistic interior real-estate photography, 24mm wide lens, eye-level tripod height, natural daylight, no people, no text, no watermark, no signage, typical American suburban home, sharp focus front to back, 4:3 aspect ratio.

---

## Project 1 - Full remodel

**Files:** `project-1-before.webp` / `project-1-after.webp`
**Alt (before):** Dated suburban kitchen before a full remodel with dark oak cabinets and laminate countertops
**Alt (after):** The same kitchen after a full remodel with white shaker cabinets, quartz countertops and recessed lighting

**BEFORE**
> A dated suburban American kitchen shot from the doorway. Dark oak raised-panel cabinets with brass knobs, beige laminate countertops with a rolled front edge and a short backsplash lip, worn cream floor tiles with darkened grout, one basic flush ceiling dome light, cramped countertop space with an old microwave and a dish rack taking up most of it, a white range and a white fridge, a small window above the sink. Dim, yellowish light, tired but clean and lived in.

**AFTER** (image-to-image from the before)
> The same kitchen, same camera angle, same window and door positions, same room dimensions. Fully remodeled: white shaker cabinets running to the ceiling, light quartz countertops with soft grey veining, a white ceramic tile backsplash to the underside of the uppers, wide-plank light oak flooring, recessed ceiling downlights plus under-cabinet task lighting, stainless steel range, hood and fridge, brushed nickel hardware, clear open counter space. Bright, even daylight.

---

## Project 2 - Small kitchen

**Files:** `project-2-before.webp` / `project-2-after.webp`
**Alt (before):** Small kitchen before remodeling with worn cabinets, cluttered counters and poor lighting
**Alt (after):** The same small kitchen after remodeling with light cabinets, quartz counters and under-cabinet lighting

**BEFORE**
> A small compact American kitchen, roughly 8 by 10 feet, shot lengthwise from the entry. Worn medium-brown wooden cabinets that stop short of the ceiling leaving a dusty gap above, cluttered countertops with small appliances and jars leaving almost no free work surface, a dated patterned tile backsplash, a single dim ceiling fixture casting shadows into the corners, a bulky old fridge crowding the walkway. Cramped, shadowy, realistic lived-in home.

**AFTER** (image-to-image from the before)
> The same compact kitchen, same viewpoint, same room size and architecture. Remodeled: light warm-white cabinets running full height to the ceiling, light quartz countertops in one clear continuous run, a simple modern backsplash, under-cabinet LED strip lighting plus recessed downlights, a counter-depth stainless fridge flush with the cabinet line, one open drawer showing fitted storage inserts, clear uncluttered work surfaces, pale large-format floor tiles. Bright and open without the walls moving.

---

## Project 3 - Island added

**Files:** `project-3-before.webp` / `project-3-after.webp`
**Alt (before):** Open kitchen before remodeling with dated cabinets and unused central floor space
**Alt (after):** The same kitchen after remodeling with a center island, quartz surfaces and pendant lighting

**BEFORE**
> An older open-plan American kitchen photographed from the dining side. Dated flat-front cabinets along the far wall only, laminate worktops with a visible seam, a large empty stretch of unused vinyl floor through the middle of the room with nothing in it, worn flooring, a traditional ceiling fixture and a small pendant over nothing in particular. Functional, plain, underused space, realistic residential photography.

**AFTER** (image-to-image from the before)
> The same kitchen, same camera position, same windows, walls and overall room geometry. Remodeled: modern flat-panel cabinetry along the perimeter, quartz surfaces throughout, and a large rectangular center island in the previously empty floor space with drawer storage, a quartz top, three counter stools along the near side and an outlet on the end panel. Two pendant lights hang over the island, updated wide-plank flooring runs through the room, clear walkways on all sides.

---

## Note before these go live

This section is a **real project gallery**, not the illustrative comparison strip further down the page. Each entry carries a city and state and reads as a completed Elite Remodel Hub job.

The theme hides the section until at least one project is entered, and the section file carries this comment:

> Hidden entirely until at least one real project has been added - never seed this repeater with placeholder or invented projects.

The content brief says the same thing: "Add only verified Elite Remodel Hub projects and service areas to these fields before publication."

So AI-generated photos paired with invented cities and invented scopes would present fabricated jobs as real client work. Fine for a staging demo the client reviews, not fine on the live site. Whatever goes live here should be the client's own project photos and details.
