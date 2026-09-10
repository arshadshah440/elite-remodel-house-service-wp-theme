<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * The Elite Remodel Hub about page, built section by section in the same
 * style as the Homepage template. Assign this template to a page and edit
 * every section under the "About Page Sections" panel below the editor.
 *
 * Each section lives in its own template part so it can be reused, reordered
 * or overridden from a child theme. The final CTA section reuses the same
 * template-parts/sections/cta.php as the homepage.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the about page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_about_sections',
	array( 'about-banner', 'about-story', 'about-mv', 'about-stats', 'about-values', 'about-team', 'cta' )
);
?>

<main id="main" class="erh-site-main erh-about">

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
