<?php
/**
 * Reusable blog post card, rendered inside the loop (after the_post()).
 *
 * Used by the home page's "Our Recent Post" section. Pass
 * array( 'featured' => true ) as get_template_part()'s $args for the large
 * first card; every other card renders as the small side-by-side variant.
 *
 * @package Elite_Remodel_Hub
 *
 * @var array $args {
 *     @type bool $featured Whether to render the large card variant.
 * }
 */

defined( 'ABSPATH' ) || exit;

$erh_featured = ! empty( $args['featured'] );
$erh_classes  = 'erh-blog-card' . ( $erh_featured ? ' erh-blog-card--featured' : ' erh-blog-card--compact' );
$erh_size     = $erh_featured ? 'erh-blog-lg' : 'erh-blog';
?>
<article <?php post_class( $erh_classes ); ?>>

	<a class="erh-blog-card__thumb" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( $erh_size, array( 'class' => 'erh-blog-card__image', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<img class="erh-blog-card__image" src="<?php echo esc_url( erh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
		<?php endif; ?>
	</a>

	<div class="erh-blog-card__body">
		<p class="erh-blog-card__meta">
			<?php echo esc_html( get_the_date() ); ?>
		</p>

		<h3 class="erh-blog-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<div class="erh-blog-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>

</article>
