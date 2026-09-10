<?php
/**
 * Template Name: Service Listing
 * Template Post Type: page
 *
 * The Elite Remodel Hub service listing page, built section by section in
 * the same style as the Homepage and About Us templates: a banner, the full
 * paginated services grid, then the shared "Why Choose Us" and "What Our
 * Client Say" sections, closing with the "Get Started" CTA. Assign this
 * template to a page and edit every section under the "Service Listing Page
 * Sections" panel below the editor.
 *
 * Each section lives in its own template part so it can be reused, reordered
 * or overridden from a child theme.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the service listing page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_service_listing_sections',
	array( 'service-listing-banner', 'service-listing-grid', 'why', 'testimonials', 'cta' )
);
?>

<main id="main" class="erh-site-main erh-service-listing-page">

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
