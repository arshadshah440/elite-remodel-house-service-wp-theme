<?php
/**
 * Location page section: Service areas.
 *
 * Intro text plus a pill list of nearby neighborhoods/towns served, and the
 * brand's address and phone number pulled from Theme Settings so it always
 * matches the footer.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_location = erh_field( 'location_name' );
$erh_title    = erh_field( 'location_areas_title' );

if ( ! $erh_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_title = sprintf( __( 'Proudly Serving %s &amp; Surrounding Areas', 'elite-remodel-hub' ), $erh_location );
}

$erh_text    = erh_field( 'location_areas_text' );
$erh_areas   = erh_field_rows( 'location_areas_list' );
$erh_address = erh_option( 'brand_address' );
$erh_phone   = erh_option( 'brand_phone' );
?>
<section class="erh-location-areas erh-section" id="service-areas">
	<div class="erh-container erh-location-areas__grid">

		<div class="erh-location-areas__content">
			<?php erh_split_heading( $erh_title, 0, 'h2' ); ?>

			<?php if ( $erh_text ) : ?>
				<p class="erh-location-areas__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>

			<?php if ( $erh_address || $erh_phone ) : ?>
				<div class="erh-location-areas__contact">
					<?php if ( $erh_address ) : ?>
						<div class="erh-location-areas__contact-item">
							<?php erh_icon( 'map-pin', array( 'size' => 18 ) ); ?>
							<span><?php echo nl2br( esc_html( $erh_address ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?></span>
						</div>
					<?php endif; ?>
					<?php if ( $erh_phone ) : ?>
						<div class="erh-location-areas__contact-item">
							<?php erh_icon( 'phone', array( 'size' => 18 ) ); ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $erh_phone ) ); ?>"><?php echo esc_html( $erh_phone ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $erh_areas ) : ?>
			<ul class="erh-location-areas__list">
				<?php foreach ( $erh_areas as $erh_area ) : ?>
					<?php $erh_area_name = isset( $erh_area['area'] ) ? $erh_area['area'] : ''; ?>
					<?php if ( ! $erh_area_name ) : ?>
						<?php continue; ?>
					<?php endif; ?>
					<li class="erh-location-areas__pill">
						<?php erh_icon( 'check', array( 'size' => 14 ) ); ?>
						<?php echo esc_html( $erh_area_name ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</div>
</section>
