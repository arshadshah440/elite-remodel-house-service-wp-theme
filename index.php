<?php
/**
 * The default fallback template.
 *
 * Used whenever a more specific template (front-page.php, page-home.php,
 * single.php, archive.php, etc.) does not exist for the current query.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="erh-site-main">
	<div class="erh-container erh-section">

		<?php if ( have_posts() ) : ?>

			<?php if ( ! is_home() && ! is_front_page() ) : ?>
				<header class="erh-page-header">
					<h1 class="erh-page-header__title"><?php the_archive_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div class="erh-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div>

			<?php the_posts_pagination( array( 'class' => 'erh-pagination' ) ); ?>

		<?php else : ?>

			<p class="erh-empty-hint"><?php esc_html_e( 'Nothing was found.', 'elite-remodel-hub' ); ?></p>

		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
