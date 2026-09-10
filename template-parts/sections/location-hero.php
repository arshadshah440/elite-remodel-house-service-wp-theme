<?php
/**
 * Location page section: Hero.
 *
 * Full-bleed photo banner with a dark overlay, breadcrumb, eyebrow, the
 * location-personalised title and text, and a row of trust badges.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_location = erh_field( 'location_name' );
$erh_bg        = erh_image( erh_field( 'location_hero_image' ), 'erh-wide' );

if ( ! $erh_bg['url'] ) {
	$erh_bg = erh_image( get_post_thumbnail_id(), 'erh-wide' );
}

if ( ! $erh_bg['url'] ) {
	$erh_bg['url'] = erh_placeholder_image_url();
}

$erh_title = erh_field( 'location_hero_title' );

if ( ! $erh_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_title = sprintf( __( 'Trusted Home Remodeling Experts in %s', 'elite-remodel-hub' ), $erh_location );
}

$erh_text   = erh_field( 'location_hero_text' );
$erh_badges = erh_field_rows( 'location_badges' );
$erh_phone  = erh_option( 'brand_phone' );
?>
<section class="erh-location-hero">

	<div class="erh-location-hero__bg" style="background-image:url('<?php echo esc_url( $erh_bg['url'] ); ?>');" aria-hidden="true"></div>
	<div class="erh-location-hero__overlay" aria-hidden="true"></div>

	<div class="erh-container erh-location-hero__inner">

		<nav class="erh-location-hero__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'elite-remodel-hub' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'elite-remodel-hub' ); ?></a>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<?php if ( $erh_location ) : ?>
			<p class="erh-eyebrow"><?php echo esc_html( sprintf( /* translators: %s: location name. */ __( 'Serving %s', 'elite-remodel-hub' ), $erh_location ) ); ?></p>
		<?php endif; ?>

		<h1 class="erh-heading erh-location-hero__title"><?php echo esc_html( $erh_title ); ?></h1>

		<?php if ( $erh_text ) : ?>
			<p class="erh-location-hero__text"><?php echo esc_html( $erh_text ); ?></p>
		<?php endif; ?>

		<div class="erh-location-hero__actions">
			<a class="erh-btn erh-btn--gold erh-btn--lg" href="#quote">
				<?php esc_html_e( 'Get a Free Quote', 'elite-remodel-hub' ); ?>
			</a>
			<?php if ( $erh_phone ) : ?>
				<a class="erh-btn erh-btn--outline erh-btn--lg" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $erh_phone ) ); ?>">
					<?php erh_icon( 'phone', array( 'size' => 18 ) ); ?>
					<?php echo esc_html( $erh_phone ); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if ( $erh_badges ) : ?>
			<ul class="erh-location-hero__badges">
				<?php foreach ( $erh_badges as $erh_badge ) : ?>
					<?php
					$erh_badge_text = isset( $erh_badge['text'] ) ? $erh_badge['text'] : '';

					if ( ! $erh_badge_text ) {
						continue;
					}

					$erh_badge_icon = isset( $erh_badge['icon'] ) && $erh_badge['icon'] ? $erh_badge['icon'] : 'shield';
					?>
					<li class="erh-location-hero__badge">
						<?php erh_icon( $erh_badge_icon, array( 'size' => 18 ) ); ?>
						<?php echo esc_html( $erh_badge_text ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</div>
</section>
