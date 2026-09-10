<?php
/**
 * Blog listing page.
 *
 * WordPress uses this file automatically for the page assigned under
 * Settings -> Reading -> "Posts page" (it is not a selectable page
 * template - there is nothing to assign). Built in the same section style
 * as the rest of the theme: a banner, the posts grid with pagination, and a
 * closing "Get Started" CTA. Edit the banner and CTA under that page's
 * "Blog Page Sections" panel.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();

$erh_page_id = (int) get_option( 'page_for_posts' );

if ( erh_section_enabled( 'blog-banner', $erh_page_id ) ) {
	get_template_part( 'template-parts/sections/blog-banner' );
}
?>

<main id="main" class="erh-site-main erh-blog-listing">

	<section class="erh-blog-listing-main erh-section">
		<div class="erh-container">

			<?php if ( have_posts() ) : ?>

				<div class="erh-blog-listing__grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/blog-listing-card' );
					endwhile;
					?>
				</div>

				<?php the_posts_pagination( array( 'class' => 'erh-pagination' ) ); ?>

			<?php else : ?>

				<p class="erh-empty-hint"><?php esc_html_e( 'No blog posts yet. Check back soon.', 'elite-remodel-hub' ); ?></p>

			<?php endif; ?>

		</div>
	</section>

	<?php
	// The main Loop above iterates blog posts, not the Blog page itself, so
	// the shared CTA section (which reads fields from "the current post")
	// needs the Blog page temporarily set as that current post.
	$erh_blog_page = $erh_page_id ? get_post( $erh_page_id ) : null;

	if ( $erh_blog_page && erh_section_enabled( 'cta', $erh_page_id ) ) :
		global $post;
		$post = $erh_blog_page; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- temporarily point the shared CTA section at the Blog page's own fields.
		setup_postdata( $post );
		get_template_part( 'template-parts/sections/cta' );
		wp_reset_postdata();
	endif;
	?>

</main>

<?php
get_footer();
