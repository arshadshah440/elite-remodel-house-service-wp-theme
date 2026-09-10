<?php
/**
 * Home section: Our Kitchen Remodeling Process.
 *
 * Numbered stages taking a kitchen from the existing room to a completed
 * remodel.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_steps = erh_field_rows( 'process_steps' );
?>
<section class="erh-process erh-section" id="process">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'process_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'process_title' ),
				(int) erh_field( 'process_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'process_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_steps ) : ?>
			<ol class="erh-process__list"<?php echo erh_grid_style( 'process_columns', 5 ); ?>>
				<?php
				$erh_number = 0;

				foreach ( $erh_steps as $erh_step ) :
					$erh_title = isset( $erh_step['title'] ) ? trim( $erh_step['title'] ) : '';

					if ( ! $erh_title ) {
						continue;
					}

					++$erh_number;
					$erh_body = isset( $erh_step['text'] ) ? $erh_step['text'] : '';
					?>
					<li class="erh-process-step">
						<span class="erh-process-step__number"><?php echo esc_html( sprintf( '%02d', $erh_number ) ); ?></span>
						<h3 class="erh-process-step__title"><?php echo esc_html( $erh_title ); ?></h3>
						<?php if ( $erh_body ) : ?>
							<p class="erh-process-step__text"><?php echo esc_html( $erh_body ); ?></p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>

	</div>
</section>
