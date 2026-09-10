<?php
/**
 * Comment list and form for single posts.
 *
 * Styled via the .erh-comments wrapper (assets/css/base.css) and the
 * comment-list / comment-form rules in assets/css/blog.css. Uses core
 * WordPress markup and classes throughout (wp_list_comments(), comment_form())
 * rather than a custom walker, so it stays compatible with any comments
 * plugin that hooks into the standard filters.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="erh-comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="erh-comments__title">
			<?php
			printf(
				/* translators: %s: number of comments. */
				esc_html( _nx( '%s Comment', '%s Comments', get_comments_number(), 'comments title', 'elite-remodel-hub' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="erh-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="erh-comments-closed"><?php esc_html_e( 'Comments are closed.', 'elite-remodel-hub' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'  => __( 'Leave a Comment', 'elite-remodel-hub' ),
			'class_submit' => 'erh-btn erh-btn--navy erh-btn--lg',
			'label_submit' => __( 'Post Comment', 'elite-remodel-hub' ),
		)
	);
	?>

</div>
