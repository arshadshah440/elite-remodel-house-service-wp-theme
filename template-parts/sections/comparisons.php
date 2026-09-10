<?php
/**
 * Kitchen Gallery page section: Category-by-category comparisons.
 *
 * One row per kitchen area (cabinets, countertops, layout, etc.) - copy on
 * one side, a drag before/after slider on the other, alternating sides row
 * by row. Uses placeholder art for the slider until real photos are added,
 * so the layout looks right from the start.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'comparisons_items' );
?>
<section class="erh-comparisons erh-section" id="comparisons">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'comparisons_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'comparisons_title' ),
				(int) erh_field( 'comparisons_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'comparisons_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_items ) : ?>
			<div class="erh-comparisons__list">
				<?php foreach ( $erh_items as $erh_item ) : ?>
					<?php
					$erh_title = isset( $erh_item['title'] ) ? trim( $erh_item['title'] ) : '';

					if ( ! $erh_title ) {
						continue;
					}

					$erh_text_1 = isset( $erh_item['text'] ) ? $erh_item['text'] : '';
					$erh_text_2 = isset( $erh_item['text_2'] ) ? $erh_item['text_2'] : '';
					$erh_before = isset( $erh_item['before_text'] ) ? trim( $erh_item['before_text'] ) : '';
					$erh_after  = isset( $erh_item['after_text'] ) ? trim( $erh_item['after_text'] ) : '';
					$erh_link   = erh_resolved_link( isset( $erh_item['link'] ) ? $erh_item['link'] : '', $erh_title );

					$erh_before_photo = erh_image( isset( $erh_item['image_before'] ) ? $erh_item['image_before'] : null, 'erh-card' );
					$erh_after_photo  = erh_image( isset( $erh_item['image_after'] ) ? $erh_item['image_after'] : null, 'erh-card' );

					if ( ! $erh_before_photo['url'] ) {
						$erh_before_photo['url'] = erh_placeholder_image_url();
					}
					if ( ! $erh_after_photo['url'] ) {
						$erh_after_photo['url'] = erh_placeholder_image_url();
					}
					?>
					<article class="erh-comparison-row">

						<div class="erh-comparison-row__content">
							<h3 class="erh-comparison-row__title"><?php echo esc_html( $erh_title ); ?></h3>

							<?php if ( $erh_text_1 ) : ?>
								<p class="erh-comparison-row__text"><?php echo esc_html( $erh_text_1 ); ?></p>
							<?php endif; ?>
							<?php if ( $erh_text_2 ) : ?>
								<p class="erh-comparison-row__text"><?php echo esc_html( $erh_text_2 ); ?></p>
							<?php endif; ?>

							<?php if ( $erh_before || $erh_after ) : ?>
								<dl class="erh-comparison-row__pair">
									<?php if ( $erh_before ) : ?>
										<div>
											<dt><?php esc_html_e( 'Before', 'elite-remodel-hub' ); ?></dt>
											<dd><?php echo esc_html( $erh_before ); ?></dd>
										</div>
									<?php endif; ?>
									<?php if ( $erh_after ) : ?>
										<div>
											<dt><?php esc_html_e( 'After', 'elite-remodel-hub' ); ?></dt>
											<dd><?php echo esc_html( $erh_after ); ?></dd>
										</div>
									<?php endif; ?>
								</dl>
							<?php endif; ?>

							<?php if ( $erh_link ) : ?>
								<a class="erh-comparison-row__more"<?php echo erh_link_attrs( $erh_link ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
									<?php echo esc_html( $erh_link['title'] ); ?>
									<?php erh_icon( 'arrow-right', array( 'size' => 16 ) ); ?>
								</a>
							<?php endif; ?>
						</div>

						<div class="erh-comparison-row__media">
							<div class="erh-compare">
								<img class="erh-compare__img erh-compare__img--after" src="<?php echo esc_url( $erh_after_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_after_photo['alt'] ? $erh_after_photo['alt'] : $erh_title . ' - ' . __( 'after', 'elite-remodel-hub' ) ); ?>" loading="lazy" decoding="async">
								<div class="erh-compare__clip">
									<img class="erh-compare__img erh-compare__img--before" src="<?php echo esc_url( $erh_before_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_before_photo['alt'] ? $erh_before_photo['alt'] : $erh_title . ' - ' . __( 'before', 'elite-remodel-hub' ) ); ?>" loading="lazy" decoding="async">
								</div>
								<span class="erh-compare__tag erh-compare__tag--before"><?php esc_html_e( 'Before', 'elite-remodel-hub' ); ?></span>
								<span class="erh-compare__tag erh-compare__tag--after"><?php esc_html_e( 'After', 'elite-remodel-hub' ); ?></span>
								<div class="erh-compare__divider" aria-hidden="true">
									<span class="erh-compare__handle">
										<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 6 9 12 15 18"></polyline></svg>
										<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 6 15 12 9 18"></polyline></svg>
									</span>
								</div>
								<input type="range" class="erh-compare__range" min="0" max="100" value="50" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: comparison row title, e.g. "Kitchen Cabinet Before and After". */ __( '%s: drag to compare before and after', 'elite-remodel-hub' ), $erh_title ) ); ?>">
							</div>
						</div>

					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
