<?php
/**
 * Home section: Our Recent Post.
 *
 * Cards pulled from the latest published blog posts - the first renders
 * large on the left, the rest stack small on the right.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_count = absint( erh_field( 'blog_count' ) );
$erh_count = $erh_count ? $erh_count : 3;

$erh_posts = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => $erh_count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
?>
<section class="erh-blog erh-section" id="blog">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php
			erh_split_heading(
				erh_field( 'blog_title' ),
				(int) erh_field( 'blog_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'blog_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_posts->have_posts() ) : ?>
			<div class="erh-blog__grid">

				<?php
				$erh_posts->the_post();
				get_template_part( 'template-parts/blog-card', null, array( 'featured' => true ) );
				?>

				<?php if ( $erh_posts->have_posts() ) : ?>
					<div class="erh-blog__side">
						<?php
						while ( $erh_posts->have_posts() ) :
							$erh_posts->the_post();
							get_template_part( 'template-parts/blog-card', null, array( 'featured' => false ) );
						endwhile;
						?>
					</div>
				<?php endif; ?>

			</div>
			<?php wp_reset_postdata(); ?>
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="erh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to write a post. */
					esc_html__( 'No blog posts yet. %s to fill this section.', 'elite-remodel-hub' ),
					'<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">'
						. esc_html__( 'Write a post', 'elite-remodel-hub' ) . '</a>'
				);
				?>
			</p>
		<?php endif; ?>

	</div>
</section>
