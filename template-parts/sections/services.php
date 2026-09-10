<?php
/**
 * Home section: Our Service.
 *
 * A 2x2 grid of full-bleed photo cards with a dark gradient overlay carrying
 * the title and short description. Cards are pulled from the "service" post
 * type - either the posts hand-picked in the "Choose services to show"
 * relationship field, or every published service in menu-order when that
 * field is left empty.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_selected = erh_field( 'services_selected' );
$erh_selected = is_array( $erh_selected ) ? array_map( 'absint', $erh_selected ) : array();

if ( $erh_selected ) {
	$erh_query_args = array(
		'post_type'           => 'service',
		'post__in'            => $erh_selected,
		'orderby'             => 'post__in',
		'posts_per_page'      => count( $erh_selected ),
		'ignore_sticky_posts' => true,
	);
} else {
	$erh_query_args = array(
		'post_type'           => 'service',
		'posts_per_page'      => 8,
		'orderby'             => 'menu_order',
		'order'               => 'ASC',
		'ignore_sticky_posts' => true,
	);
}

$erh_services = new WP_Query( $erh_query_args );
?>
<section class="erh-services erh-section" id="services">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php
			erh_split_heading(
				erh_field( 'services_title' ),
				(int) erh_field( 'services_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'services_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_services->have_posts() ) : ?>
			<div class="erh-services__grid">
				<?php
				while ( $erh_services->have_posts() ) :
					$erh_services->the_post();

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
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="erh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to add a service. */
					esc_html__( 'No services yet. %s to fill this section.', 'elite-remodel-hub' ),
					'<a href="' . esc_url( admin_url( 'post-new.php?post_type=service' ) ) . '">'
						. esc_html__( 'Add a service', 'elite-remodel-hub' ) . '</a>'
				);
				?>
			</p>
		<?php endif; ?>

	</div>
</section>
