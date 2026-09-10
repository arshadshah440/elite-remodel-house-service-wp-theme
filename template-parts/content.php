<?php
/**
 * Generic post/page entry card used by index.php.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'erh-entry' ); ?>>

	<a class="erh-entry__thumb" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'erh-blog', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( erh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
		<?php endif; ?>
	</a>

	<h2 class="erh-entry__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>

	<p class="erh-entry__meta">
		<?php
		printf(
			/* translators: 1: post date, 2: post author. */
			esc_html__( '%1$s by %2$s', 'elite-remodel-hub' ),
			esc_html( get_the_date() ),
			esc_html( get_the_author() )
		);
		?>
	</p>

	<div class="erh-entry__excerpt">
		<?php the_excerpt(); ?>
	</div>

</article>
