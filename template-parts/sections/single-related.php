<?php
/**
 * Single post section: Related posts.
 *
 * Up to 3 other posts sharing a category with this one, falling back to the
 * most recent posts when this one has no category. Reuses the same
 * .erh-blog-listing-card component as the Blog listing page.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_categories = wp_get_post_categories( get_the_ID() );

$erh_query_args = array(
	'post_type'           => 'post',
	'post__not_in'        => array( get_the_ID() ),
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);

if ( $erh_categories ) {
	$erh_query_args['category__in'] = $erh_categories;
}

$erh_related = new WP_Query( $erh_query_args );

if ( ! $erh_related->have_posts() ) {
	return;
}
?>
<section class="erh-single-related erh-section" id="related-posts">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( __( 'You Might Also Like', 'elite-remodel-hub' ), 0, 'h2' ); ?>
		</div>

		<div class="erh-blog-listing__grid erh-single-related__grid">
			<?php
			while ( $erh_related->have_posts() ) :
				$erh_related->the_post();
				get_template_part( 'template-parts/blog-listing-card' );
			endwhile;
			?>
		</div>

		<?php wp_reset_postdata(); ?>

	</div>
</section>
