<?php
/**
 * Home section: What Can a Kitchen Remodel Include?
 *
 * The full scope checklist, rendered as a multi-column tick list with the
 * two closing notes below it.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items  = erh_field_rows( 'scope_items' );
$erh_note   = erh_field( 'scope_note' );
$erh_note_2 = erh_field( 'scope_note_2' );
?>
<section class="erh-scope erh-section" id="remodel-scope">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'scope_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'scope_title' ),
				(int) erh_field( 'scope_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'scope_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_items ) : ?>
			<ul class="erh-scope__list"<?php echo erh_grid_style( 'scope_columns', 4 ); ?>>
				<?php foreach ( $erh_items as $erh_item ) : ?>
					<?php
					$erh_label = isset( $erh_item['text'] ) ? trim( $erh_item['text'] ) : '';

					if ( ! $erh_label ) {
						continue;
					}
					?>
					<li class="erh-scope__item">
						<span class="erh-scope__tick" aria-hidden="true"><?php erh_icon( 'check', array( 'size' => 14 ) ); ?></span>
						<span><?php echo esc_html( $erh_label ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( $erh_note || $erh_note_2 ) : ?>
			<div class="erh-scope__notes">
				<?php if ( $erh_note ) : ?>
					<p><?php echo esc_html( $erh_note ); ?></p>
				<?php endif; ?>
				<?php if ( $erh_note_2 ) : ?>
					<p><?php echo esc_html( $erh_note_2 ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
