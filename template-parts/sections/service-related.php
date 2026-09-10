<?php
/**
 * Service detail section: Explore Other Services.
 *
 * Up to 3 other published services, reusing the exact same .erh-service-card
 * component as the home page's "Our Service" teaser and the Service Listing
 * page's grid, so the look stays identical everywhere it appears.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_related = new WP_Query(
	array(
		'post_type'           => 'service',
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => 3,
		'orderby'             => 'menu_order',
		'order'               => 'ASC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( ! $erh_related->have_posts() ) {
	return;
}

$erh_listing_url = erh_service_listing_url();
?>
<section class="erh-service-related erh-section" id="related-services">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( __( 'Explore Other Services', 'elite-remodel-hub' ), 0, 'h2' ); ?>
		</div>

		<div class="erh-services__grid erh-service-related__grid">
			<?php
			while ( $erh_related->have_posts() ) :
				$erh_related->the_post();

				$erh_image_url = get_the_post_thumbnail_url( get_the_ID(), 'erh-service' );
				if ( ! $erh_image_url ) {
					$erh_image_url = erh_placeholder_image_url();
				}

				$erh_excerpt = get_the_excerpt();
				?>
				<a class="erh-service-card" href="<?php the_permalink(); ?>">
					<img class="erh-service-card__image" src="<?php echo esc_url( $erh_image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async">
					<span class="erh-service-card__overlay" aria-hidden="true"></span>
					<span class="erh-service-card__body">
						<span class="erh-service-card__title"><?php the_title(); ?></span>
						<?php if ( $erh_excerpt ) : ?>
							<span class="erh-service-card__text"><?php echo esc_html( $erh_excerpt ); ?></span>
						<?php endif; ?>
					</span>
				</a>
			<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>



	</div>
</section>
