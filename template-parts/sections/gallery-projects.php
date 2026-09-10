<?php
/**
 * Kitchen Gallery page section: Project gallery.
 *
 * Real Elite Remodel Hub before/after projects, each with a location, a
 * before photo and description, the remodel scope, and an after photo and
 * description. Hidden entirely until at least one real project has been
 * added - never seed this repeater with placeholder or invented projects.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_rows = erh_field_rows( 'gallery_projects' );

if ( ! $erh_rows ) {
	return;
}
?>
<section class="erh-gallery-projects erh-section" id="gallery">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'gallery_projects_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'gallery_projects_title' ),
				(int) erh_field( 'gallery_projects_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'gallery_projects_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<div class="erh-gallery-projects__list">
			<?php foreach ( $erh_rows as $erh_row ) : ?>
				<?php
				$erh_location = isset( $erh_row['location'] ) ? trim( $erh_row['location'] ) : '';

				if ( ! $erh_location ) {
					continue;
				}

				$erh_before_photo = erh_image( isset( $erh_row['image_before'] ) ? $erh_row['image_before'] : null, 'erh-compare' );
				$erh_after_photo  = erh_image( isset( $erh_row['image_after'] ) ? $erh_row['image_after'] : null, 'erh-compare' );
				$erh_before_text  = isset( $erh_row['before_text'] ) ? $erh_row['before_text'] : '';
				$erh_remodel_text = isset( $erh_row['remodel_text'] ) ? $erh_row['remodel_text'] : '';
				$erh_after_text   = isset( $erh_row['after_text'] ) ? $erh_row['after_text'] : '';
				?>
				<article class="erh-gallery-project">
					<h3 class="erh-gallery-project__location"><?php echo esc_html( $erh_location ); ?></h3>

					<div class="erh-gallery-project__photos">
						<figure class="erh-gallery-project__photo">
							<?php if ( $erh_before_photo['url'] ) : ?>
								<img src="<?php echo esc_url( $erh_before_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_before_photo['alt'] ); ?>" loading="lazy" decoding="async">
							<?php endif; ?>
							<figcaption><?php esc_html_e( 'Before', 'elite-remodel-hub' ); ?></figcaption>
						</figure>
						<figure class="erh-gallery-project__photo">
							<?php if ( $erh_after_photo['url'] ) : ?>
								<img src="<?php echo esc_url( $erh_after_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_after_photo['alt'] ); ?>" loading="lazy" decoding="async">
							<?php endif; ?>
							<figcaption><?php esc_html_e( 'After', 'elite-remodel-hub' ); ?></figcaption>
						</figure>
					</div>

					<div class="erh-gallery-project__body">
						<?php if ( $erh_before_text ) : ?>
							<p><strong><?php esc_html_e( 'Before:', 'elite-remodel-hub' ); ?></strong> <?php echo esc_html( $erh_before_text ); ?></p>
						<?php endif; ?>
						<?php if ( $erh_remodel_text ) : ?>
							<p><strong><?php esc_html_e( 'Remodel:', 'elite-remodel-hub' ); ?></strong> <?php echo esc_html( $erh_remodel_text ); ?></p>
						<?php endif; ?>
						<?php if ( $erh_after_text ) : ?>
							<p><strong><?php esc_html_e( 'After:', 'elite-remodel-hub' ); ?></strong> <?php echo esc_html( $erh_after_text ); ?></p>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
