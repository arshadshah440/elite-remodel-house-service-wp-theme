<?php
/**
 * Blog listing card, rendered inside the loop (after the_post()).
 *
 * Used by the Blog listing page (home.php) and the "Related Posts" section
 * on single.php. A photo-top card distinct from the homepage teaser's
 * .erh-blog-card (which is tightly coupled to that section's fixed-height
 * layout) - styled in assets/css/blog.css.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_categories = get_the_category();
$erh_category   = $erh_categories ? $erh_categories[0] : null;
?>
<article <?php post_class( 'erh-blog-listing-card' ); ?>>

	<a class="erh-blog-listing-card__thumb" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'erh-blog', array( 'class' => 'erh-blog-listing-card__image', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<img class="erh-blog-listing-card__image" src="<?php echo esc_url( erh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
		<?php endif; ?>
	</a>

	<div class="erh-blog-listing-card__body">
		<p class="erh-blog-listing-card__meta">
			
			<?php echo esc_html( get_the_date() ); ?>
		</p>

		<h3 class="erh-blog-listing-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<div class="erh-blog-listing-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<a class="erh-btn-arrow" href="<?php the_permalink(); ?>">
			<span class="erh-btn-arrow__label"><?php esc_html_e( 'Read More', 'elite-remodel-hub' ); ?></span>
			<span class="erh-btn-arrow__icon"><?php erh_icon( 'arrow-right', array( 'size' => 18 ) ); ?></span>
		</a>
	</div>

</article>
