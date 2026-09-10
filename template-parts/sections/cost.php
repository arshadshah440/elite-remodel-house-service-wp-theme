<?php
/**
 * Home section: Kitchen Remodeling Costs and Project Planning.
 *
 * Explains what moves the price of a remodel and links out to the detailed
 * cost guide.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_paragraphs = array(
	erh_field( 'cost_text' ),
	erh_field( 'cost_text_2' ),
	erh_field( 'cost_text_3' ),
	erh_field( 'cost_text_4' ),
);

$erh_factors = erh_field_rows( 'cost_factors' );
$erh_link    = erh_resolved_link( erh_field( 'cost_link' ), __( 'View the cost guide', 'elite-remodel-hub' ) );
?>
<section class="erh-cost erh-section" id="cost">
	<div class="erh-container erh-cost__grid">

		<div class="erh-cost__content">
			<?php erh_eyebrow( erh_field( 'cost_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'cost_title' ),
				(int) erh_field( 'cost_title_highlight' ),
				'h2'
			);
			?>

			<?php
			foreach ( $erh_paragraphs as $erh_paragraph ) :
				if ( ! $erh_paragraph ) {
					continue;
				}
				?>
				<p class="erh-cost__copy"><?php echo esc_html( $erh_paragraph ); ?></p>
				<?php
			endforeach;
			?>

			<?php if ( $erh_link ) : ?>
				<a class="erh-btn erh-btn--navy"<?php echo erh_link_attrs( $erh_link ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
					<?php echo esc_html( $erh_link['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if ( $erh_factors ) : ?>
			<aside class="erh-cost__panel">
				<h3 class="erh-cost__panel-title"><?php echo esc_html( erh_field( 'cost_factors_title' ) ); ?></h3>
				<ul class="erh-cost__factors">
					<?php foreach ( $erh_factors as $erh_factor ) : ?>
						<?php
						$erh_label = isset( $erh_factor['text'] ) ? trim( $erh_factor['text'] ) : '';

						if ( ! $erh_label ) {
							continue;
						}
						?>
						<li><?php echo esc_html( $erh_label ); ?></li>
					<?php endforeach; ?>
				</ul>
			</aside>
		<?php endif; ?>

	</div>
</section>
