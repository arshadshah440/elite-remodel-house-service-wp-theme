<?php
/**
 * Location page section: Stats bar.
 *
 * A short navy strip of key numbers - reuses the same .erh-stat markup as
 * the About page's Stats section (about.css) for a consistent look.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'location_stats_items' );

if ( ! $erh_items ) {
	return;
}
?>
<section class="erh-location-stats">
	<div class="erh-container">
		<div class="erh-stats__grid erh-location-stats__grid">
			<?php foreach ( $erh_items as $erh_item ) : ?>
				<?php
				$erh_value = isset( $erh_item['value'] ) ? $erh_item['value'] : '';
				$erh_label = isset( $erh_item['label'] ) ? $erh_item['label'] : '';

				if ( ! $erh_value && ! $erh_label ) {
					continue;
				}
				?>
				<div class="erh-stat">
					<?php if ( $erh_value ) : ?>
						<div class="erh-stat__value"><?php echo esc_html( $erh_value ); ?></div>
					<?php endif; ?>
					<?php if ( $erh_label ) : ?>
						<div class="erh-stat__label"><?php echo esc_html( $erh_label ); ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
