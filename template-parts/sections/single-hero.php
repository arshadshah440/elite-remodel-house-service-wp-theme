<?php
/**
 * Single post section: Hero.
 *
 * Full-bleed photo hero (the post's featured image, falling back to the
 * theme placeholder) with a dark overlay, breadcrumb, category eyebrow,
 * title and a meta row - the same hero pattern used on the Service detail
 * and Location page templates (service-hero.php, location-hero.php).
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_bg = erh_image( get_post_thumbnail_id(), 'erh-wide' );

if ( ! $erh_bg['url'] ) {
	$erh_bg['url'] = erh_placeholder_image_url();
}

$erh_categories = get_the_category();
$erh_category   = $erh_categories ? $erh_categories[0] : null;
$erh_page_id    = (int) get_option( 'page_for_posts' );
$erh_blog_url   = $erh_page_id ? get_permalink( $erh_page_id ) : '';
?>
<section class="erh-single-hero">

	<div class="erh-single-hero__bg" style="background-image:url('<?php echo esc_url( $erh_bg['url'] ); ?>');" aria-hidden="true"></div>
	<div class="erh-single-hero__overlay" aria-hidden="true"></div>

	<div class="erh-container erh-single-hero__inner">

		<nav class="erh-single-hero__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'elite-remodel-hub' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'elite-remodel-hub' ); ?></a>
			<span aria-hidden="true">/</span>
			<?php if ( $erh_blog_url ) : ?>
				<a href="<?php echo esc_url( $erh_blog_url ); ?>"><?php esc_html_e( 'Blog', 'elite-remodel-hub' ); ?></a>
			<?php else : ?>
				<span><?php esc_html_e( 'Blog', 'elite-remodel-hub' ); ?></span>
			<?php endif; ?>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<?php erh_eyebrow( $erh_category ? $erh_category->name : __( 'Our Blog', 'elite-remodel-hub' ) ); ?>

		<h1 class="erh-heading erh-single-hero__title"><?php the_title(); ?></h1>

		<div class="erh-single-hero__meta">
			<span class="erh-single-hero__author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- get_avatar() returns escaped markup. ?>
				<?php echo esc_html( get_the_author() ); ?>
			</span>
			<span aria-hidden="true">&middot;</span>
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span aria-hidden="true">&middot;</span>
			<span><?php echo esc_html( erh_reading_time() ); ?></span>
		</div>

	</div>
</section>
