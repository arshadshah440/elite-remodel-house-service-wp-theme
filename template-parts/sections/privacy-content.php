<?php
/**
 * Privacy Policy page section: Editable policy content.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_sections       = erh_field_rows( 'privacy_sections' );
$erh_request_email  = erh_field( 'privacy_request_email' );
$erh_request_address = erh_field( 'privacy_request_address' );
?>
<section class="erh-privacy-content erh-section">
	<div class="erh-container erh-privacy-content__layout">
		<aside class="erh-privacy-content__aside">
			<div class="erh-privacy-meta">
				<span class="erh-privacy-meta__label"><?php esc_html_e( 'Last updated', 'elite-remodel-hub' ); ?></span>
				<strong><?php echo esc_html( erh_field( 'privacy_last_updated' ) ); ?></strong>
				<span class="erh-privacy-meta__label"><?php esc_html_e( 'Version', 'elite-remodel-hub' ); ?></span>
				<strong><?php echo esc_html( erh_field( 'privacy_version' ) ); ?></strong>
			</div>

			<?php if ( $erh_sections ) : ?>
				<nav class="erh-privacy-nav" aria-label="<?php esc_attr_e( 'Privacy policy sections', 'elite-remodel-hub' ); ?>">
					<span class="erh-privacy-nav__title"><?php esc_html_e( 'On this page', 'elite-remodel-hub' ); ?></span>
					<?php foreach ( $erh_sections as $erh_index => $erh_section ) : ?>
						<?php if ( empty( $erh_section['title'] ) ) { continue; } ?>
						<a href="#privacy-section-<?php echo esc_attr( (int) $erh_index + 1 ); ?>">
							<span><?php echo esc_html( (int) $erh_index + 1 ); ?></span>
							<?php echo esc_html( $erh_section['title'] ); ?>
						</a>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>
		</aside>

		<div class="erh-privacy-content__body">
			<div class="erh-privacy-intro">
				<?php echo wp_kses_post( wpautop( erh_field( 'privacy_intro' ) ) ); ?>
			</div>

			<?php foreach ( $erh_sections as $erh_index => $erh_section ) : ?>
				<?php
				$erh_title = isset( $erh_section['title'] ) ? trim( $erh_section['title'] ) : '';
				$erh_body  = isset( $erh_section['body'] ) ? trim( $erh_section['body'] ) : '';

				if ( ! $erh_title || ! $erh_body ) {
					continue;
				}
				?>
				<section class="erh-privacy-section" id="privacy-section-<?php echo esc_attr( (int) $erh_index + 1 ); ?>">
					<h2><span><?php echo esc_html( (int) $erh_index + 1 ); ?></span><?php echo esc_html( $erh_title ); ?></h2>
					<div class="erh-privacy-section__text"><?php echo wp_kses_post( wpautop( $erh_body ) ); ?></div>
				</section>
			<?php endforeach; ?>

			<section class="erh-privacy-request" id="privacy-request">
				<?php erh_eyebrow( erh_field( 'privacy_request_eyebrow' ) ); ?>
				<h2><?php echo esc_html( erh_field( 'privacy_request_title' ) ); ?></h2>
				<div class="erh-privacy-section__text"><?php echo wp_kses_post( wpautop( erh_field( 'privacy_request_text' ) ) ); ?></div>
				<?php if ( $erh_request_email || $erh_request_address ) : ?>
					<div class="erh-privacy-request__details">
						<?php if ( $erh_request_email ) : ?>
							<a href="mailto:<?php echo esc_attr( sanitize_email( $erh_request_email ) ); ?>"><?php echo esc_html( $erh_request_email ); ?></a>
						<?php endif; ?>
						<?php if ( $erh_request_address ) : ?>
							<span><?php echo nl2br( esc_html( $erh_request_address ) ); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</section>

			<?php $erh_states_text = erh_field( 'privacy_state_notice' ); ?>
			<?php if ( $erh_states_text ) : ?>
				<section class="erh-privacy-state-note">
					<h2><?php esc_html_e( 'State privacy rights', 'elite-remodel-hub' ); ?></h2>
					<div class="erh-privacy-section__text"><?php echo wp_kses_post( wpautop( $erh_states_text ) ); ?></div>
				</section>
			<?php endif; ?>
		</div>
	</div>
</section>