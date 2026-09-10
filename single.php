<?php
/**
 * Single blog post.
 *
 * Built in the same section style as the rest of the theme: a photo hero
 * (breadcrumb, category, title, meta - the same pattern as the Service
 * detail and Location page templates), the post content, related posts,
 * comments, and a closing "Get Started" CTA. Related posts and the CTA can
 * each be switched off from the "Blog Post Sections" panel below the
 * editor.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Optional sections rendered after the post content and before comments, in
 * order. The hero and content always render - see template-parts/sections/
 * single-hero.php and single-content.php. The closing CTA renders after
 * comments, separately below.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$erh_sections = apply_filters(
	'erh_single_post_sections',
	array( 'single-related' )
);
?>

<main id="main" class="erh-site-main erh-single-post">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/sections/single-hero' );
		get_template_part( 'template-parts/sections/single-content' );

		foreach ( $erh_sections as $erh_section ) {
			if ( erh_section_enabled( $erh_section ) ) {
				get_template_part( 'template-parts/sections/' . $erh_section );
			}
		}

		if ( comments_open() || get_comments_number() ) :
			?>
			<div class="erh-container">
				<?php comments_template(); ?>
			</div>
			<?php
		endif;

		if ( erh_section_enabled( 'cta' ) ) {
			get_template_part( 'template-parts/sections/cta' );
		}

	endwhile;
	?>

</main>

<?php
get_footer();
