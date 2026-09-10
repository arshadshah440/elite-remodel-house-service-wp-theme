<?php

/**
 * Service Listing page section: Services grid.
 *
 * Every published "service" post, paginated. Cards reuse the same
 * .erh-service-card component as the home page's "Our Service" teaser
 * (template-parts/sections/services.php) so the two stay visually
 * identical; unlike that teaser, this section always lists the full
 * catalogue in menu-order rather than a hand-picked subset, and paginates
 * using the "Services per page" field.
 *
 * @package Elite_Remodel_Hub
 */

defined('ABSPATH') || exit;

$erh_per_page = absint(erh_field('service_listing_per_page'));
$erh_per_page = $erh_per_page ? $erh_per_page : 9;

$erh_paged = get_query_var('paged') ? absint(get_query_var('paged')) : (get_query_var('page') ? absint(get_query_var('page')) : 1);

$erh_services = new WP_Query(
	array(
		'post_type'           => 'service',
		'posts_per_page'      => $erh_per_page,
		'paged'               => $erh_paged,
		'orderby'             => 'menu_order',
		'order'               => 'ASC',
		'post_parent'         => 0, // Only parent-level services

		'ignore_sticky_posts' => true,
	)
);
?>
<section class="erh-service-listing erh-section" id="services">
	<div class="erh-container">

		<?php if ($erh_services->have_posts()) : ?>
			<div class="erh-service-listing__grid">
				<?php
				while ($erh_services->have_posts()) :
					$erh_services->the_post();

					$erh_image_url = get_the_post_thumbnail_url(get_the_ID(), 'erh-service');
					if (! $erh_image_url) {
						$erh_image_url = erh_placeholder_image_url();
					}

					$erh_excerpt = get_the_excerpt();
				?>
					<a class="erh-service-card" href="<?php the_permalink(); ?>">
						<img class="erh-service-card__image" src="<?php echo esc_url($erh_image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
						<span class="erh-service-card__overlay" aria-hidden="true"></span>
						<span class="erh-service-card__body">
							<span class="erh-service-card__title"><?php the_title(); ?></span>
							<?php if ($erh_excerpt) : ?>
								<span class="erh-service-card__text"><?php echo esc_html($erh_excerpt); ?></span>
							<?php endif; ?>
						</span>
					</a>
				<?php endwhile; ?>
			</div>

			<?php
			$erh_big   = 999999999;
			$erh_links = paginate_links(
				array(
					'base'      => str_replace($erh_big, '%#%', esc_url(get_pagenum_link($erh_big))),
					'format'    => '?paged=%#%',
					'current'   => max(1, $erh_paged),
					'total'     => $erh_services->max_num_pages,
					'type'      => 'list',
					'end_size'  => 1,
					'mid_size'  => 1,
					'prev_text' => erh_get_icon('chevron-left', array('size' => 16, 'label' => __('Previous', 'elite-remodel-hub'))),
					'next_text' => erh_get_icon('chevron-right', array('size' => 16, 'label' => __('Next', 'elite-remodel-hub'))),
				)
			);

			if ($erh_links) :
			?>
				<nav class="erh-pagination" aria-label="<?php esc_attr_e('Services pagination', 'elite-remodel-hub'); ?>">
					<?php echo $erh_links; // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- built and escaped by paginate_links(). 
					?>
				</nav>
			<?php
			endif;
			?>

			<?php wp_reset_postdata(); ?>
		<?php elseif (current_user_can('edit_posts')) : ?>
			<p class="erh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to add a service. */
					esc_html__('No services yet. %s to fill this page.', 'elite-remodel-hub'),
					'<a href="' . esc_url(admin_url('post-new.php?post_type=service')) . '">'
						. esc_html__('Add a service', 'elite-remodel-hub') . '</a>'
				);
				?>
			</p>
		<?php endif; ?>

	</div>
</section>