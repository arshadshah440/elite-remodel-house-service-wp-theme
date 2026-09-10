<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * The Elite Remodel Hub kitchen remodeling home page, built section by
 * section. Assign this template to a page and edit every section under the
 * "Home Page Sections" panel below the editor.
 *
 * Each section lives in its own template part so it can be reused, reordered
 * or overridden from a child theme.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the home page, in order.
 *
 * Each slug maps to template-parts/sections/{slug}.php and is gated by a
 * matching "{slug}_enable" toggle in the Home Page Sections panel, so a
 * section can be switched off without editing this list.
 *
 * "services", "blog" and "testimonials" stay in the list but ship switched
 * off - the kitchen remodeling page uses its own services grid and has no
 * post or testimonial section. Turn either toggle back on to restore them.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_home_sections',
	array(
		'hero',
		'about',
		'kservices',
		'scope',
		'planning',
		'process',
		'cost',
		'contractor',
		'locations',
		'why',
		'ideas',
		'faq',
		'cta',
		'services',
		'blog',
		'testimonials',
	)
);
?>

<main id="main" class="erh-site-main erh-home">

	<?php
	while ( have_posts() ) :
		the_post();

		foreach ( $erh_sections as $erh_section ) {
			if ( erh_section_enabled( $erh_section ) ) {
				get_template_part( 'template-parts/sections/' . $erh_section );
			}
		}

		// Anything typed into the editor renders after the designed sections.
		$erh_editor_content = trim( get_the_content() );

		if ( $erh_editor_content ) :
			?>
			<div class="erh-section">
				<div class="erh-container erh-entry-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
		endif;

	endwhile;
	?>

</main>

<?php
get_footer();
