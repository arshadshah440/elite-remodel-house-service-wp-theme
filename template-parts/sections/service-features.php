<?php
/**
 * Service detail section: What's Included.
 *
 * A grid of feature cards - icon, title, short text - describing what comes
 * standard with this service.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'service_features_items' );

if ( ! $erh_items ) {
	return;
}
?>
<section class="erh-service-features erh-section" id="whats-included">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( erh_field( 'service_features_title' ), 0, 'h2' ); ?>
		</div>

		<div class="erh-service-features__grid">
			<?php foreach ( $erh_items as $erh_item ) : ?>
				<?php
				$erh_icon_slug = isset( $erh_item['icon'] ) && $erh_item['icon'] ? $erh_item['icon'] : 'tool';
				$erh_title     = isset( $erh_item['title'] ) ? $erh_item['title'] : '';
				$erh_text      = isset( $erh_item['text'] ) ? $erh_item['text'] : '';

				if ( ! $erh_title ) {
					continue;
				}
				?>
				<div class="erh-service-feature-card">
					<span class="erh-service-feature-card__icon"><?php erh_icon( $erh_icon_slug, array( 'size' => 22 ) ); ?></span>
					<h3 class="erh-service-feature-card__title"><?php echo esc_html( $erh_title ); ?></h3>
					<?php if ( $erh_text ) : ?>
						<p class="erh-service-feature-card__text"><?php echo esc_html( $erh_text ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
