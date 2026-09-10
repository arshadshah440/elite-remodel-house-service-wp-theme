<?php
/**
 * Template Name: FAQ
 * Template Post Type: page
 *
 * The Elite Remodel Hub FAQ page, built section by section and powered by
 * fields attached to the page. Each section can be switched off from the
 * "FAQ Page Sections" panel below the editor.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the FAQ page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_faq_sections',
	array( 'faq-banner', 'faq-content', 'cta' )
);
?>

<main id="main" class="erh-site-main erh-faq">

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
