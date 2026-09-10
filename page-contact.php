<?php
/**
 * Template Name: Contact Us
 * Template Post Type: page
 *
 * The Elite Remodel Hub contact page, built section by section in the same
 * style as the Homepage and About Us templates. Assign this template to a
 * page and edit every section under the "Contact Page Sections" panel
 * below the editor.
 *
 * The contact form posts to admin-post.php and is handled by
 * inc/contact-form.php via plain wp_mail() - no forms plugin required.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the contact page, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_contact_sections',
	array( 'contact-banner', 'contact-info-form', 'contact-map' )
);
?>

<main id="main" class="erh-site-main erh-contact">

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
