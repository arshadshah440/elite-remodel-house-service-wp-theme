<?php
/**
 * Service detail section: Hero.
 *
 * Full-bleed photo banner (falls back to the featured image, then the
 * theme placeholder) with a dark overlay, breadcrumb, eyebrow, the service
 * title and tagline, and two calls to action.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_bg = erh_image( erh_field( 'service_hero_image' ), 'erh-wide' );

if ( ! $erh_bg['url'] ) {
	$erh_bg = erh_image( get_post_thumbnail_id(), 'erh-wide' );
}

if ( ! $erh_bg['url'] ) {
	$erh_bg['url'] = erh_placeholder_image_url();
}

$erh_tagline      = erh_field( 'service_tagline' );
$erh_listing_url  = erh_service_listing_url();
$erh_contact_url  = erh_contact_page_url();
$erh_phone        = erh_option( 'brand_phone' );

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#contact';
}
?>
<section class="erh-service-hero">

	<div class="erh-service-hero__bg" style="background-image:url('<?php echo esc_url( $erh_bg['url'] ); ?>');" aria-hidden="true"></div>
	<div class="erh-service-hero__overlay" aria-hidden="true"></div>

	<div class="erh-container erh-service-hero__inner">

		<nav class="erh-service-hero__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'elite-remodel-hub' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'elite-remodel-hub' ); ?></a>
			<span aria-hidden="true">/</span>
			<?php if ( $erh_listing_url ) : ?>
				<a href="<?php echo esc_url( $erh_listing_url ); ?>"><?php esc_html_e( 'Services', 'elite-remodel-hub' ); ?></a>
			<?php else : ?>
				<span><?php esc_html_e( 'Services', 'elite-remodel-hub' ); ?></span>
			<?php endif; ?>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<p class="erh-eyebrow"><?php esc_html_e( 'Our Services', 'elite-remodel-hub' ); ?></p>

		<h1 class="erh-heading erh-service-hero__title"><?php the_title(); ?></h1>

		<?php if ( $erh_tagline ) : ?>
			<p class="erh-service-hero__text"><?php echo esc_html( $erh_tagline ); ?></p>
		<?php endif; ?>

		<div class="erh-service-hero__actions">
			<a class="erh-btn erh-btn--gold erh-btn--lg" href="<?php echo esc_url( $erh_contact_url ); ?>">
				<?php esc_html_e( 'Get a Free Estimate', 'elite-remodel-hub' ); ?>
			</a>
			<?php if ( $erh_phone ) : ?>
				<a class="erh-btn erh-btn--outline erh-btn--lg" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $erh_phone ) ); ?>">
					<?php erh_icon( 'phone', array( 'size' => 18 ) ); ?>
					<?php echo esc_html( $erh_phone ); ?>
				</a>
			<?php endif; ?>
		</div>

	</div>
</section>
