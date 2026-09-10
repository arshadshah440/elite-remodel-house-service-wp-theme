<?php
/**
 * Location page section: Recent projects gallery.
 *
 * An optional grid of local project photos, each with a short caption.
 * Hidden entirely when no photos have been added.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_rows = erh_field_rows( 'location_gallery' );

if ( ! $erh_rows ) {
	return;
}

$erh_location = erh_field( 'location_name' );
$erh_title    = erh_field( 'location_gallery_title' );

if ( ! $erh_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_title = sprintf( __( 'Recent Projects in %s', 'elite-remodel-hub' ), $erh_location );
}
?>
<section class="erh-location-gallery erh-section" id="gallery">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( $erh_title, 0, 'h2' ); ?>
		</div>

		<div class="erh-location-gallery__grid">
			<?php foreach ( $erh_rows as $erh_row ) : ?>
				<?php
				$erh_photo = isset( $erh_row['image'] ) ? erh_image( $erh_row['image'], 'erh-gallery' ) : erh_image( null );

				if ( ! $erh_photo['url'] ) {
					continue;
				}

				$erh_caption = isset( $erh_row['caption'] ) ? $erh_row['caption'] : '';
				?>
				<figure class="erh-location-gallery__item">
					<img src="<?php echo esc_url( $erh_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_caption ? $erh_caption : $erh_photo['alt'] ); ?>" loading="lazy" decoding="async">
					<?php if ( $erh_caption ) : ?>
						<figcaption><?php echo esc_html( $erh_caption ); ?></figcaption>
					<?php endif; ?>
				</figure>
			<?php endforeach; ?>
		</div>

	</div>
</section>
