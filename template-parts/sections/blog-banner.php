<?php
/**
 * Blog listing page section: Banner.
 *
 * Compact navy intro band with a breadcrumb, page title and short intro
 * text - uses the same shared .erh-page-banner styles (assets/css/pages.css)
 * as every other custom page template.
 *
 * Fields live on whichever page is set as Settings -> Reading -> "Posts
 * page", via the "Blog Page Sections" panel (ACF location: Page Type =
 * Posts Page).
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_page_id = (int) get_option( 'page_for_posts' );
$erh_text    = erh_field( 'blog_banner_text', null, $erh_page_id );
?>
<section class="erh-page-banner">
	<div class="erh-container">

		<nav class="erh-page-banner__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'elite-remodel-hub' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'elite-remodel-hub' ); ?></a>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php esc_html_e( 'Blog', 'elite-remodel-hub' ); ?></span>
		</nav>

		<?php erh_eyebrow( erh_field( 'blog_banner_eyebrow', null, $erh_page_id ) ); ?>

		<?php
		erh_split_heading(
			erh_field( 'blog_banner_title', null, $erh_page_id ),
			(int) erh_field( 'blog_banner_title_highlight', null, $erh_page_id ),
			'h1'
		);
		?>

		<?php if ( $erh_text ) : ?>
			<p class="erh-page-banner__text"><?php echo esc_html( $erh_text ); ?></p>
		<?php endif; ?>

	</div>
</section>
