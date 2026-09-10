<?php
/**
 * Template Name: Kitchen Remodel Gallery
 * Template Post Type: page
 *
 * The Elite Remodel Hub kitchen remodel before-and-after page: a banner, an
 * intro on what a remodel can change, a real project gallery (hidden until
 * projects are added), category-by-category before/after comparisons, the
 * remodeling process, verified project examples by state, an FAQ, and the
 * shared "Get Started" CTA. Assign this template to a page and edit every
 * section under the "Kitchen Gallery Page Sections" panel below the editor.
 *
 * Each section lives in its own template part so it can be reused, reordered
 * or overridden from a child theme. The intro, process, state-examples, FAQ
 * and CTA sections reuse the same template-parts/sections/planning.php,
 * process.php, locations.php, faq.php and cta.php as the Home and Service
 * Detail templates.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the kitchen gallery page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_kitchen_gallery_sections',
	array( 'gallery-banner', 'planning', 'gallery-projects', 'comparisons', 'essays', 'process', 'locations', 'faq', 'cta' )
);
?>

<main id="main" class="erh-site-main erh-kitchen-gallery">

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
