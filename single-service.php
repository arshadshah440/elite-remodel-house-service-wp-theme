<?php
/**
 * Single Service (Service Detail page).
 *
 * A full, section-based detail page for one "service" post - a photo hero,
 * the written overview with a "Quick Facts" sidebar, a "What's Included"
 * feature grid, a numbered process, an optional project gallery, other
 * services to explore, and a personalised "Get Started" CTA. Built in the
 * same section-per-template-part style as the page templates; edit each
 * service's content under the "Service Detail" panel below its editor.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the service detail page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_service_single_sections',
	array( 'service-hero', 'calculator', 'service-overview', 'kservices', 'scope', 'planning', 'service-process', 'cost', 'contractor', 'locations', 'service-features', 'ideas', 'faq', 'service-gallery', 'service-related', 'service-cta' )
);
?>

<main id="main" class="erh-site-main erh-service-single">

	<?php
	while ( have_posts() ) :
		the_post();

		foreach ( $erh_sections as $erh_section ) {
			if ( erh_section_enabled( $erh_section ) ) {
				get_template_part( 'template-parts/sections/' . $erh_section );
			}
		}

	endwhile;
	?>

</main>

<?php
get_footer();
