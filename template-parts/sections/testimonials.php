<?php

/**
 * Home section: What Our Client Say.
 *
 * A full-width Owl Carousel slider of quote cards pulled from the
 * "testimonial" post type - either the posts hand-picked in the "Choose
 * testimonials to show" relationship field, or every published testimonial
 * in menu-order when that field is left empty. One card can be marked
 * "highlighted" to render with a solid navy fill.
 *
 * @package Elite_Remodel_Hub
 */

defined('ABSPATH') || exit;

$erh_selected = erh_field('testimonials_selected');
$erh_selected = is_array($erh_selected) ? array_map('absint', $erh_selected) : array();

if ($erh_selected) {
	$erh_query_args = array(
		'post_type'           => 'testimonial',
		'post__in'            => $erh_selected,
		'orderby'             => 'post__in',
		'posts_per_page'      => count($erh_selected),
		'ignore_sticky_posts' => true,
	);
} else {
	$erh_query_args = array(
		'post_type'           => 'testimonial',
		'posts_per_page'      => 6,
		'orderby'             => 'menu_order',
		'order'               => 'ASC',
		'ignore_sticky_posts' => true,
	);
}

$erh_testimonials = new WP_Query($erh_query_args);
?>
<section class="erh-testimonials erh-section" id="testimonials">

	<div class="erh-container">
		<div class="erh-section-head">
			<?php
			erh_split_heading(
				erh_field('testimonials_title'),
				(int) erh_field('testimonials_title_highlight'),
				'h2'
			);
			?>
			<?php $erh_text = erh_field('testimonials_text'); ?>
			<?php if ($erh_text) : ?>
				<p class="erh-section-head__text"><?php echo esc_html($erh_text); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($erh_testimonials->have_posts()) : ?>
		<div class="owl-carousel erh-testimonials__slider" id="erh-testimonials-owl">
			<?php
			while ($erh_testimonials->have_posts()) :
				$erh_testimonials->the_post();

				$erh_quote     = erh_field('quote');
				$erh_role      = erh_field('role');
				$erh_rating    = (float) erh_field('rating', 5);
				$erh_highlight = (bool) erh_field('highlight', false);
			?>
				<figure class="erh-testimonial-card<?php echo $erh_highlight ? ' erh-testimonial-card--highlight' : ''; ?>">

					<span class="erh-testimonial-card__quote-icon" aria-hidden="true">&#8220;</span>

					<?php if ($erh_quote) : ?>
						<blockquote class="erh-testimonial-card__text">&#8220;<?php echo esc_html($erh_quote); ?>&#8221;</blockquote>
					<?php endif; ?>

					<figcaption class="erh-testimonial-card__person">
						<span class="erh-testimonial-card__avatar">
							<?php if (has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('thumbnail', array('loading' => 'lazy', 'alt' => '')); ?>
							<?php else : ?>
								<?php erh_icon('users', array('size' => 18)); ?>
							<?php endif; ?>
						</span>
						<span class="erh-testimonial-card__meta">
							<span class="erh-testimonial-card__name"><?php the_title(); ?></span>
							<?php if ($erh_role) : ?>
								<span class="erh-testimonial-card__role"><?php echo esc_html($erh_role); ?></span>
							<?php endif; ?>
							<?php erh_stars($erh_rating); ?>

						</span>
					</figcaption>


				</figure>
			<?php endwhile; ?>
		</div>

		<?php if ($erh_testimonials->post_count > 1) : ?>
			<div class="erh-testimonials__dots" id="erh-testimonials-dots" aria-label="<?php esc_attr_e('Testimonial slides', 'elite-remodel-hub'); ?>"></div>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	<?php elseif (current_user_can('edit_posts')) : ?>
		<div class="erh-container">
			<p class="erh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to add a testimonial. */
					esc_html__('No testimonials yet. %s to fill this section.', 'elite-remodel-hub'),
					'<a href="' . esc_url(admin_url('post-new.php?post_type=testimonial')) . '">'
						. esc_html__('Add a testimonial', 'elite-remodel-hub') . '</a>'
				);
				?>
			</p>
		</div>
	<?php endif; ?>

</section>