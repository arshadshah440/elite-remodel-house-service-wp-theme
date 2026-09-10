<?php
/**
 * About page section: Values.
 *
 * A grid of value cards - icon, title, short text.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'values_items' );
?>
<section class="erh-about-values erh-section" id="values">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'values_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'values_title' ),
				(int) erh_field( 'values_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'values_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_items ) : ?>
			<div class="erh-values__grid">
				<?php foreach ( $erh_items as $erh_item ) : ?>
					<?php
					$erh_icon_slug = isset( $erh_item['icon'] ) && $erh_item['icon'] ? $erh_item['icon'] : 'shield';
					$erh_title     = isset( $erh_item['title'] ) ? $erh_item['title'] : '';
					$erh_desc      = isset( $erh_item['text'] ) ? $erh_item['text'] : '';

					if ( ! $erh_title ) {
						continue;
					}
					?>
					<div class="erh-value-card">
						<span class="erh-value-card__icon"><?php erh_icon( $erh_icon_slug, array( 'size' => 22 ) ); ?></span>
						<h3 class="erh-value-card__title"><?php echo esc_html( $erh_title ); ?></h3>
						<?php if ( $erh_desc ) : ?>
							<p class="erh-value-card__text"><?php echo esc_html( $erh_desc ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
