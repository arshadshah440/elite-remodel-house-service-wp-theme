<?php
/**
 * Template Name: Privacy Policy
 * Template Post Type: page
 *
 * The Elite Remodel Hub privacy policy page, powered by fields attached to
 * the page so the policy can be maintained without editing theme files.
 * Each section can be switched off from the "Privacy Policy Sections" panel
 * below the editor.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the privacy policy page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_privacy_sections',
	array( 'privacy-banner', 'privacy-content' )
);
?>

<main id="main" class="erh-site-main erh-privacy-policy">

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
