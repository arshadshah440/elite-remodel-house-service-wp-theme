<?php
/**
 * Service detail section: Project gallery.
 *
 * An optional grid of project photos. Hidden entirely when no photos have
 * been added.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_rows = erh_field_rows( 'service_gallery' );

if ( ! $erh_rows ) {
	return;
}
?>
<section class="erh-service-gallery erh-section" id="gallery">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( __( 'Project Gallery', 'elite-remodel-hub' ), 0, 'h2' ); ?>
		</div>

		<div class="erh-service-gallery__grid">
			<?php foreach ( $erh_rows as $erh_row ) : ?>
				<?php
				$erh_photo = isset( $erh_row['image'] ) ? erh_image( $erh_row['image'], 'erh-gallery' ) : erh_image( null );

				if ( ! $erh_photo['url'] ) {
					continue;
				}
				?>
				<div class="erh-service-gallery__item">
					<img src="<?php echo esc_url( $erh_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_photo['alt'] ); ?>" loading="lazy" decoding="async">
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
