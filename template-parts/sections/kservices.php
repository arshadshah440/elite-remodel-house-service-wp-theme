<?php
/**
 * Home section: Explore Our Kitchen Remodeling Services.
 *
 * A grid of icon cards, one per kitchen remodeling service, each linking to
 * its own service page. Rows come from the "Services grid" repeater in the
 * Home Page Sections panel, so the copy and the destination of every card
 * are editable without touching this file.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'kservices_items' );
?>
<section class="erh-kservices erh-section" id="kitchen-services">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'kservices_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'kservices_title' ),
				(int) erh_field( 'kservices_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'kservices_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_items ) : ?>
			<div class="erh-kservices__grid"<?php echo erh_grid_style( 'kservices_columns', 3 ); ?>>
				<?php foreach ( $erh_items as $erh_item ) : ?>
					<?php
					$erh_title = isset( $erh_item['title'] ) ? trim( $erh_item['title'] ) : '';

					if ( ! $erh_title ) {
						continue;
					}

					$erh_icon = ! empty( $erh_item['icon'] ) ? $erh_item['icon'] : 'tool';
					$erh_desc = isset( $erh_item['text'] ) ? $erh_item['text'] : '';
					$erh_link = erh_resolved_link( isset( $erh_item['link'] ) ? $erh_item['link'] : '', $erh_title );

					if ( $erh_link ) {
						printf(
							'<a class="erh-kservice-card"%s>',
							erh_link_attrs( $erh_link ) // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs().
						);
					} else {
						echo '<div class="erh-kservice-card">';
					}
					?>
						<span class="erh-kservice-card__icon"><?php erh_icon( $erh_icon, array( 'size' => 24 ) ); ?></span>
						<h3 class="erh-kservice-card__title"><?php echo esc_html( $erh_title ); ?></h3>
						<?php if ( $erh_desc ) : ?>
							<p class="erh-kservice-card__text"><?php echo esc_html( $erh_desc ); ?></p>
						<?php endif; ?>
						<?php if ( $erh_link ) : ?>
							<span class="erh-kservice-card__more">
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
