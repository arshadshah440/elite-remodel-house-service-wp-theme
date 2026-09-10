<?php
/**
 * Single post section: Content.
 *
 * The post body in a readable centered column, then simple previous/next
 * post navigation.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="erh-single-content erh-section">
	<div class="erh-container erh-container--narrow">

		<div class="erh-entry-content">
			<?php the_content(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<nav class="erh-single-pages" aria-label="' . esc_attr__( 'Page', 'elite-remodel-hub' ) . '">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>

		<?php
		$erh_prev = get_previous_post_link( '%link', __( 'Previous Post', 'elite-remodel-hub' ) );
		$erh_next = get_next_post_link( '%link', __( 'Next Post', 'elite-remodel-hub' ) );

		if ( $erh_prev || $erh_next ) :
			?>
			<nav class="erh-single-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'elite-remodel-hub' ); ?>">
				<div class="erh-single-nav__prev"><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
				<div class="erh-single-nav__next"><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
			</nav>
			<?php
		endif;
		?>

	</div>
</section>
