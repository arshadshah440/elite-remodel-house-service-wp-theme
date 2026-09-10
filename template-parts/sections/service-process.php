<?php
/**
 * Service detail section: Our Process.
 *
 * Numbered steps walking through how this service is delivered.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_steps = erh_field_rows( 'service_process_steps' );

if ( ! $erh_steps ) {
	return;
}
?>
<section class="erh-service-process erh-section" id="process">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_split_heading( erh_field( 'service_process_title' ), 0, 'h2' ); ?>
		</div>

		<ol class="erh-service-process__list">
			<?php
			$erh_step_number = 0;

			foreach ( $erh_steps as $erh_step ) :
				$erh_title = isset( $erh_step['title'] ) ? $erh_step['title'] : '';
				$erh_text  = isset( $erh_step['text'] ) ? $erh_step['text'] : '';

				if ( ! $erh_title ) {
					continue;
				}

				++$erh_step_number;
				?>
				<li class="erh-service-process-step">
					<span class="erh-service-process-step__number"><?php echo esc_html( sprintf( '%02d', $erh_step_number ) ); ?></span>
					<h3 class="erh-service-process-step__title"><?php echo esc_html( $erh_title ); ?></h3>
					<?php if ( $erh_text ) : ?>
						<p class="erh-service-process-step__text"><?php echo esc_html( $erh_text ); ?></p>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>

	</div>
</section>
