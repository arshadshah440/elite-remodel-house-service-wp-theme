<?php
/**
 * Home section: Kitchen Remodeling by State.
 *
 * One card per state served, each linking to that state's own page.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'locations_items' );
?>
<section class="erh-locations erh-section" id="service-areas">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'locations_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'locations_title' ),
				(int) erh_field( 'locations_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'locations_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_items ) : ?>
			<div class="erh-locations__grid"<?php echo erh_grid_style( 'locations_columns', 4 ); ?>>
				<?php foreach ( $erh_items as $erh_item ) : ?>
					<?php
					$erh_name = isset( $erh_item['name'] ) ? trim( $erh_item['name'] ) : '';

					if ( ! $erh_name ) {
						continue;
					}

					$erh_desc = isset( $erh_item['text'] ) ? $erh_item['text'] : '';
					$erh_link = erh_resolved_link( isset( $erh_item['link'] ) ? $erh_item['link'] : '', $erh_name );

					if ( $erh_link ) {
						printf(
							'<a class="erh-location-card"%s>',
							erh_link_attrs( $erh_link ) // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs().
						);
					} else {
						echo '<div class="erh-location-card">';
					}
					?>
						<span class="erh-location-card__pin" aria-hidden="true"><?php erh_icon( 'map-pin', array( 'size' => 20 ) ); ?></span>
						<h3 class="erh-location-card__name"><?php echo esc_html( $erh_name ); ?></h3>
						<?php if ( $erh_desc ) : ?>
							<p class="erh-location-card__text"><?php echo esc_html( $erh_desc ); ?></p>
						<?php endif; ?>
						<?php if ( $erh_link ) : ?>
							<span class="erh-location-card__more">
								<?php echo esc_html( $erh_link['title'] ); ?>
								<?php erh_icon( 'arrow-right', array( 'size' => 16 ) ); ?>
							</span>
						<?php endif; ?>
					<?php echo $erh_link ? '</a>' : '</div>'; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
