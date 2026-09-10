<?php
/**
 * Template Name: Location
 * Template Post Type: page
 *
 * The Elite Remodel Hub location / service-area landing page, built section
 * by section in the same style as the other page templates: a photo hero
 * with trust badges, an overview section (written copy alongside a
 * free-quote form), a stats bar, a services teaser, the shared "Why Choose
 * Us" and "What Our Client Say" sections, local insights, an optional
 * project gallery, the areas served, and a personalised closing CTA.
 * Assign this template to a page (e.g. "Austin, TX Remodeling") and
 * edit every section under the "Location Page Sections" panel below the
 * editor - starting with the "Location name" field, which personalises
 * headings throughout the page.
 *
 * Each section lives in its own template part so it can be reused, reordered
 * or overridden from a child theme.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the location page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_location_sections',
	array(
		'location-hero',
		'location-overview',
		'location-stats',
		'location-services',
		'why',
		'location-insights',
		'location-gallery',
		'testimonials',
		'location-areas',
		'location-cta',
	)
);
?>

<main id="main" class="erh-site-main erh-location-page">

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
