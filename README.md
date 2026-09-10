# Elite Remodel Hub

A WordPress theme for the Elite Remodel Hub landing page, built the same way as
[Pool Ready Home](../pool-ready-home): a fully field-driven header, footer and
home page powered by Secure Custom Fields (SCF) / Advanced Custom Fields Pro
options pages, with the field groups exported to `acf-json/` and version
controlled alongside the code.

## Requirements

- WordPress 6.0+
- PHP 7.4+
- [Secure Custom Fields](https://wordpress.org/plugins/secure-custom-fields/) (or ACF Pro)

The theme still renders sensible placeholder content with no fields plugin
active (see `inc/defaults.php`), but every string/image/toggle described
below only becomes editable once one is installed and activated.

## Setup

1. Activate the theme.
2. Install & activate Secure Custom Fields (or ACF Pro).
3. Set the site logo, phone/email/address and brand colors under
   **Theme Settings → Header / Footer / Brand & Contact**.
4. Assign the **Primary Menu (header)** navigation menu under
   *Appearance → Menus*.
5. Create a page, assign it the **Homepage** template, and fill in the
   **Home Page Sections** panel below the editor.
6. Set that page as the site's static front page under
   *Settings → Reading* (optional, but recommended).

## Theme settings (options pages)

| Sub-page | Menu slug | Controls |
|---|---|---|
| Header | `erh-header-settings` | Logo, header style (solid/sticky/overlay), "Contact Us" CTA button |
| Footer | `erh-footer-settings` | Brand column, quick links, contact column, newsletter, bottom bar |
| Brand & Contact | `erh-brand-settings` | Phone, email, address, hours, brand colors (shared everywhere) |

## Homepage template (`page-home.php`)

Sections render in a fixed, filterable order (`erh_home_sections`), each
independently toggled by its own `{section}_enable` field:

| Section | Slug | Key fields |
|---|---|---|
| Hero | `hero` | `hero_title`, `hero_text`, `hero_button`, `hero_gallery` (repeater) |
| About | `about` | `about_eyebrow`, `about_title`, `about_text`, `about_button`, 3 photos |
| Why Choose Us | `why` | `why_title`, `why_text`, `why_bg_image`, `why_items` (repeater, one card can be `highlight`ed) |
| Services | `services` | `services_title`, `services_text`, `services_selected` (relationship, pulls from the **Service** post type) |
| Get Started CTA | `cta` | `cta_title`, `cta_text`, `cta_button`, `cta_bg_image` |
| Blog | `blog` | `blog_title`, `blog_text`, `blog_count` — pulls from real posts, first one shown large |
| Testimonials | `testimonials` | `testimonials_title`, `testimonials_text`, `testimonials_selected` (relationship, pulls from the **Testimonial** post type) |

Every section title supports a `{section}_title_highlight` number field that
controls how many trailing words render in gold (see `erh_split_heading()`
in `inc/template-tags.php`).

## About page template (`page-about.php`)

Same architecture as the Homepage template - a fixed, filterable section
order (`erh_about_sections`), each in its own template part:

| Section | Slug | Key fields |
|---|---|---|
| Banner | `about-banner` | `about_banner_eyebrow`, `about_banner_title`, `about_banner_text` |
| Story | `about-story` | `story_eyebrow`, `story_title`, `story_text`, `story_text_2`, `story_button`, 3 photos - reuses the home page's `.erh-about__*` collage styles, mirrored |
| Mission & Vision | `about-mv` | `mission_title`/`mission_text`, `vision_title`/`vision_text` |
| Stats | `about-stats` | `stats_items` (repeater: `value`, `label`) |
| Values | `about-values` | `values_title`, `values_text`, `values_items` (repeater: icon/title/text) |
| Team | `about-team` | `team_title`, `team_text`, `team_members` (repeater: photo/name/role) |
| Get Started CTA | `cta` | Same `template-parts/sections/cta.php` the homepage uses, with its own `cta_title`/`cta_text`/`cta_button`/`cta_bg_image` values for this page |

Fields live in `acf-json/group_erh_about.json`; fallback copy is in
`inc/defaults.php`. Assign the "About Us" template to any page to use it.
Section-specific CSS is in `assets/css/about.css`, enqueued only on this
template (on top of `home.css`, which several sections reuse classes from).

## Contact page template (`page-contact.php`)

Same architecture again (`erh_contact_sections`):

| Section | Slug | Key fields |
|---|---|---|
| Banner | `contact-banner` | `contact_banner_eyebrow`, `contact_banner_title`, `contact_banner_text` |
| Info & Form | `contact-info-form` | `contact_form_eyebrow`/`title`/`text`, plus a working contact form |
| Map | `contact-map` | `contact_map_embed_url` (Google Maps embed URL) - section is skipped entirely when empty |

The contact info column (phone/email/address/hours/socials) is **not**
separate fields - it reads `brand_phone`, `brand_email`, `brand_address`,
`brand_hours`, `brand_map_url` and `footer_socials` from Theme Settings, so
it's always in sync with the footer.

The form posts to `admin-post.php` and is handled by `inc/contact-form.php`
via plain `wp_mail()` - no forms plugin needed. It's protected by a WP
nonce and a hidden honeypot field, sends to `brand_email` (falling back to
the site admin email), and redirects back to the page with `?erh_contact=success`
or `=error`, which `contact-info-form.php` reads to show a themed notice.

Fields live in `acf-json/group_erh_contact.json`; fallback copy is in
`inc/defaults.php`. Section-specific CSS is in `assets/css/contact.css`.
Both this and the About template share `assets/css/pages.css` for the
navy banner component (`.erh-page-banner`).

## FAQ page template (`page-faq.php`)

The FAQ template renders the shared banner, a responsive accessible accordion,
and the reusable Get Started CTA. Assign the "FAQ" template to a page and
edit its content under the **FAQ Page Sections** panel:

| Section | Fields |
|---|---|
| Banner | `faq_banner_eyebrow`, `faq_banner_title`, `faq_banner_text` |
| Questions | `faq_content_eyebrow`/`title`/`text`, `faq_items` repeater (`question`, `answer`) |
| Get Started CTA | `cta_title`, `cta_text`, `cta_button`, `cta_bg_image` |

Fields live in `acf-json/group_erh_faq.json`; fallback copy is in
`inc/defaults.php`. FAQ-specific styling is in `assets/css/faq.css`.

## Privacy Policy template (`page-privacy-policy.php`)

The Privacy Policy template includes a branded banner, sticky section index,
editable policy introduction, numbered policy sections, a privacy request block
and a state-rights notice for California, Oregon, Florida and Washington.
Assign the "Privacy Policy" template to a page and edit its content under the
**Privacy Policy Sections** panel. Fields live in
`acf-json/group_erh_privacy.json`; fallback copy is in `inc/defaults.php` and
the page styles are in `assets/css/privacy.css`.

## Services & Testimonials (custom post types)

Both are registered in `inc/cpt.php`:

- **Service** (`service`) — public, has its own permalink (`single-service.php`).
  Title, editor content, excerpt (the short card blurb) and a featured
  image. Manage under **Services** in the admin menu.
- **Testimonial** (`testimonial`) — admin-only, no public page. Title is the
  client's name, featured image is their photo, plus `role`, `quote`,
  `rating` (1–5) and `highlight` fields (`acf-json/group_erh_testimonial.json`).
  Manage under **Testimonials** in the admin menu.

The homepage's `services_selected` / `testimonials_selected` relationship
fields let an admin hand-pick and order specific posts; left empty, the
section shows every published post of that type instead. `inc/seed.php`
seeds the original starter content (4 services, 3 testimonials) once, the
first time the theme runs.

## Front-end assets

No build step - plain CSS/JS, cache-busted with `filemtime()` in
`inc/enqueue.php`:

```
assets/css/tokens.css   - design tokens (colors, type, spacing)
assets/css/base.css     - reset, typography, WordPress core classes, buttons, forms
assets/css/header.css   - site header / navigation
assets/css/footer.css   - site footer
assets/css/home.css     - Homepage template sections
assets/js/navigation.js - mobile nav drawer
assets/js/home.js       - hero gallery dot pagination
```
