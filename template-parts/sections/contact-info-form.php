<?php
/**
 * Contact page section: Info & Form.
 *
 * Contact details + socials on the left (pulled from Theme Settings →
 * Brand & Contact and → Footer, so they always match the footer), a
 * working contact form on the right (handled by inc/contact-form.php via
 * admin-post.php - no forms plugin required).
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_phone   = erh_option( 'brand_phone' );
$erh_email   = erh_option( 'brand_email' );
$erh_address = erh_option( 'brand_address' );
$erh_hours   = erh_option( 'brand_hours' );
$erh_map_url = erh_option( 'brand_map_url' );
$erh_socials = erh_rows( 'footer_socials' );

$erh_status = isset( $_GET['erh_contact'] ) ? sanitize_key( wp_unslash( $_GET['erh_contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only status flag, form submission itself is nonce-verified.
?>
<section class="erh-contact-main erh-section" id="contact-form">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'contact_form_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'contact_form_title' ),
				(int) erh_field( 'contact_form_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'contact_form_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<div class="erh-contact__grid">

			<div class="erh-contact-info">

				<?php if ( $erh_phone ) : ?>
					<div class="erh-contact-info__item">
						<span class="erh-contact-info__icon"><?php erh_icon( 'phone', array( 'size' => 18 ) ); ?></span>
						<div>
							<div class="erh-contact-info__label"><?php esc_html_e( 'Call Us', 'elite-remodel-hub' ); ?></div>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $erh_phone ) ); ?>"><?php echo esc_html( $erh_phone ); ?></a>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $erh_email ) : ?>
					<div class="erh-contact-info__item">
						<span class="erh-contact-info__icon"><?php erh_icon( 'mail', array( 'size' => 18 ) ); ?></span>
						<div>
							<div class="erh-contact-info__label"><?php esc_html_e( 'Email Us', 'elite-remodel-hub' ); ?></div>
							<a href="mailto:<?php echo esc_attr( sanitize_email( $erh_email ) ); ?>"><?php echo esc_html( $erh_email ); ?></a>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $erh_address ) : ?>
					<div class="erh-contact-info__item">
						<span class="erh-contact-info__icon"><?php erh_icon( 'map-pin', array( 'size' => 18 ) ); ?></span>
						<div>
							<div class="erh-contact-info__label"><?php esc_html_e( 'Visit Us', 'elite-remodel-hub' ); ?></div>
							<?php if ( $erh_map_url ) : ?>
								<a href="<?php echo esc_url( $erh_map_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo nl2br( esc_html( $erh_address ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?></a>
							<?php else : ?>
								<span><?php echo nl2br( esc_html( $erh_address ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?></span>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $erh_hours ) : ?>
					<div class="erh-contact-info__item">
						<span class="erh-contact-info__icon"><?php erh_icon( 'clock', array( 'size' => 18 ) ); ?></span>
						<div>
							<div class="erh-contact-info__label"><?php esc_html_e( 'Working Hours', 'elite-remodel-hub' ); ?></div>
							<span><?php echo esc_html( $erh_hours ); ?></span>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $erh_socials ) : ?>
					<ul class="erh-socials erh-contact-info__socials">
						<?php foreach ( $erh_socials as $erh_social ) : ?>
							<?php
							$erh_social_url = isset( $erh_social['social_url'] ) ? $erh_social['social_url'] : '';

							if ( ! $erh_social_url ) {
								continue;
							}

							$erh_social_icon = isset( $erh_social['social_icon'] ) ? $erh_social['social_icon'] : 'auto';

							if ( ! $erh_social_icon || 'auto' === $erh_social_icon ) {
								$erh_social_icon = erh_icon_from_url( $erh_social_url );
							}

							$erh_social_label = isset( $erh_social['social_label'] ) && $erh_social['social_label']
								? $erh_social['social_label']
								: ucfirst( str_replace( '-', ' ', $erh_social_icon ) );
							?>
							<li>
								<a href="<?php echo esc_url( $erh_social_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php erh_icon( $erh_social_icon, array( 'size' => 16 ) ); ?>
									<span class="screen-reader-text"><?php echo esc_html( $erh_social_label ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

			</div>

			<div class="erh-contact-form-wrap">

				<?php if ( 'success' === $erh_status ) : ?>
					<p class="erh-form-notice erh-form-notice--success" role="status">
						<?php esc_html_e( 'Thanks! Your message has been sent - we will be in touch shortly.', 'elite-remodel-hub' ); ?>
					</p>
				<?php elseif ( 'error' === $erh_status ) : ?>
					<p class="erh-form-notice erh-form-notice--error" role="alert">
						<?php esc_html_e( 'Something went wrong sending your message. Please check the form and try again.', 'elite-remodel-hub' ); ?>
					</p>
				<?php endif; ?>

				<form class="erh-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="erh_contact_form">
					<input type="hidden" name="erh_redirect" value="<?php echo esc_url( get_permalink() ); ?>">
					<?php wp_nonce_field( 'erh_contact_form', 'erh_contact_nonce' ); ?>

					<div class="erh-form-hp" aria-hidden="true">
						<label for="erh_company"><?php esc_html_e( 'Company', 'elite-remodel-hub' ); ?>
							<input type="text" id="erh_company" name="erh_company" tabindex="-1" autocomplete="off">
						</label>
					</div>

					<div class="erh-form-row">
						<div class="erh-form-field">
							<label for="erh_name"><?php esc_html_e( 'Full Name', 'elite-remodel-hub' ); ?> *</label>
							<input type="text" id="erh_name" name="erh_name" required>
						</div>
						<div class="erh-form-field">
							<label for="erh_email"><?php esc_html_e( 'Email Address', 'elite-remodel-hub' ); ?> *</label>
							<input type="email" id="erh_email" name="erh_email" required>
						</div>
					</div>

					<div class="erh-form-row">
						<div class="erh-form-field">
							<label for="erh_phone"><?php esc_html_e( 'Phone Number', 'elite-remodel-hub' ); ?></label>
							<input type="tel" id="erh_phone" name="erh_phone">
						</div>
						<div class="erh-form-field">
							<label for="erh_subject"><?php esc_html_e( 'Subject', 'elite-remodel-hub' ); ?></label>
							<input type="text" id="erh_subject" name="erh_subject">
						</div>
					</div>

					<div class="erh-form-field">
						<label for="erh_message"><?php esc_html_e( 'Message', 'elite-remodel-hub' ); ?> *</label>
						<textarea id="erh_message" name="erh_message" rows="5" required></textarea>
					</div>

					<button type="submit" class="erh-btn erh-btn--navy erh-btn--lg erh-btn--block">
						<?php esc_html_e( 'Send Message', 'elite-remodel-hub' ); ?>
					</button>
				</form>

			</div>

		</div>

	</div>
</section>
