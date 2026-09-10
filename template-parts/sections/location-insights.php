<?php
/**
 * Location page section: Local insights.
 *
 * A grid of cards explaining what makes remodeling in this area distinct -
 * local housing stock, permitting, climate, neighborhood style, and so on.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'location_insights_items' );

if ( ! $erh_items ) {
	return;
}

$erh_location = erh_field( 'location_name' );
$erh_title    = erh_field( 'location_insights_title' );

if ( ! $erh_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_title = sprintf( __( 'Why %s Homeowners Trust Us', 'elite-remodel-hub' ), $erh_location );
}
?>
<section class="erh-location-insights erh-section" id="local-insights">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( $erh_title, 0, 'h2' ); ?>
			<?php $erh_text = erh_field( 'location_insights_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<div class="erh-location-insights__grid">
			<?php foreach ( $erh_items as $erh_item ) : ?>
				<?php
				$erh_icon_slug = isset( $erh_item['icon'] ) && $erh_item['icon'] ? $erh_item['icon'] : 'home';
				$erh_title_txt = isset( $erh_item['title'] ) ? $erh_item['title'] : '';
				$erh_text_txt  = isset( $erh_item['text'] ) ? $erh_item['text'] : '';

				if ( ! $erh_title_txt ) {
					continue;
				}
				?>
				<div class="erh-location-insight-card">
					<span class="erh-location-insight-card__icon"><?php erh_icon( $erh_icon_slug, array( 'size' => 22 ) ); ?></span>
					<h3 class="erh-location-insight-card__title"><?php echo esc_html( $erh_title_txt ); ?></h3>
					<?php if ( $erh_text_txt ) : ?>
						<p class="erh-location-insight-card__text"><?php echo esc_html( $erh_text_txt ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
