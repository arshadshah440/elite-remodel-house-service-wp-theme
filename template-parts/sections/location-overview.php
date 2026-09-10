<?php
/**
 * Location page section: Overview + quote form.
 *
 * Written overview about serving this area on the left, the free quote form
 * on the right. The form posts to the same admin-post.php handler as the
 * Contact page's form (inc/contact-form.php) - no separate handler needed.
 * The "Service" dropdown posts straight into the email subject line, and
 * its options are pulled live from the published Service posts.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_location = erh_field( 'location_name' );
$erh_title    = erh_field( 'location_overview_title' );

if ( ! $erh_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_title = sprintf( __( 'Remodeling Contractors %s Homeowners Trust', 'elite-remodel-hub' ), $erh_location );
}

$erh_text   = erh_field( 'location_overview_text' );
$erh_text_2 = erh_field( 'location_overview_text_2' );
$erh_points = erh_field_rows( 'location_overview_points' );

$erh_form_title = erh_field( 'location_form_title' );

if ( ! $erh_form_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_form_title = sprintf( __( 'Get Your Free %s Remodeling Estimate', 'elite-remodel-hub' ), $erh_location );
}

$erh_form_text = erh_field( 'location_form_text' );

$erh_services = get_posts(
	array(
		'post_type'      => 'service',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

$erh_status = isset( $_GET['erh_contact'] ) ? sanitize_key( wp_unslash( $_GET['erh_contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only status flag, form submission itself is nonce-verified.
?>
<section class="erh-location-overview erh-section" id="quote">
	<div class="erh-container erh-location-overview__grid">

		<div class="erh-location-overview__content">
			<?php erh_eyebrow( erh_field( 'location_overview_eyebrow' ) ); ?>

			<?php erh_split_heading( $erh_title, (int) erh_field( 'location_overview_title_highlight' ), 'h2' ); ?>

			<?php if ( $erh_text ) : ?>
				<p class="erh-location-overview__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>

			<?php if ( $erh_text_2 ) : ?>
				<p class="erh-location-overview__text"><?php echo esc_html( $erh_text_2 ); ?></p>
			<?php endif; ?>

			<?php if ( $erh_points ) : ?>
				<ul class="erh-location-overview__points">
					<?php foreach ( $erh_points as $erh_point ) : ?>
						<?php $erh_point_text = isset( $erh_point['text'] ) ? $erh_point['text'] : ''; ?>
						<?php if ( ! $erh_point_text ) : ?>
							<?php continue; ?>
						<?php endif; ?>
						<li>
							<?php erh_icon( 'check', array( 'size' => 16 ) ); ?>
							<?php echo esc_html( $erh_point_text ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="erh-location-form__card">

			<div class="erh-section-head erh-location-form__head">
				<h4 class="erh-heading"><?php echo esc_html( $erh_form_title ); ?></h4>
				<?php if ( $erh_form_text ) : ?>
					<p class="erh-section-head__text"><?php echo esc_html( $erh_form_text ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( 'success' === $erh_status ) : ?>
				<p class="erh-form-notice erh-form-notice--success" role="status">
					<?php esc_html_e( 'Thanks! Your request has been sent - we will be in touch shortly.', 'elite-remodel-hub' ); ?>
				</p>
			<?php elseif ( 'error' === $erh_status ) : ?>
				<p class="erh-form-notice erh-form-notice--error" role="alert">
					<?php esc_html_e( 'Something went wrong sending your request. Please check the form and try again.', 'elite-remodel-hub' ); ?>
				</p>
			<?php endif; ?>

			<form class="erh-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="erh_contact_form">
				<input type="hidden" name="erh_redirect" value="<?php echo esc_url( get_permalink() . '#quote' ); ?>">
				<?php wp_nonce_field( 'erh_contact_form', 'erh_contact_nonce' ); ?>

				<div class="erh-form-hp" aria-hidden="true">
					<label for="erh_loc_company"><?php esc_html_e( 'Company', 'elite-remodel-hub' ); ?>
						<input type="text" id="erh_loc_company" name="erh_company" tabindex="-1" autocomplete="off">
					</label>
				</div>

				<div class="erh-form-row">
					<div class="erh-form-field">
						<label for="erh_loc_name"><?php esc_html_e( 'Full Name', 'elite-remodel-hub' ); ?> *</label>
						<input type="text" id="erh_loc_name" name="erh_name" required>
					</div>
					<div class="erh-form-field">
						<label for="erh_loc_phone"><?php esc_html_e( 'Phone Number', 'elite-remodel-hub' ); ?></label>
						<input type="tel" id="erh_loc_phone" name="erh_phone">
					</div>
				</div>

				<div class="erh-form-field">
					<label for="erh_loc_email"><?php esc_html_e( 'Email Address', 'elite-remodel-hub' ); ?> *</label>
					<input type="email" id="erh_loc_email" name="erh_email" required>
				</div>

				<div class="erh-form-field">
					<label for="erh_loc_subject"><?php esc_html_e( 'Service Needed', 'elite-remodel-hub' ); ?></label>
					<select id="erh_loc_subject" name="erh_subject">
						<option value=""><?php esc_html_e( 'Select a service', 'elite-remodel-hub' ); ?></option>
						<?php foreach ( $erh_services as $erh_service ) : ?>
							<option value="<?php echo esc_attr( $erh_service->post_title ); ?>"><?php echo esc_html( $erh_service->post_title ); ?></option>
						<?php endforeach; ?>
						<option value="<?php esc_attr_e( 'Something else', 'elite-remodel-hub' ); ?>"><?php esc_html_e( 'Something else', 'elite-remodel-hub' ); ?></option>
					</select>
				</div>

				<div class="erh-form-field">
					<label for="erh_loc_message"><?php esc_html_e( 'Tell Us About Your Project', 'elite-remodel-hub' ); ?> *</label>
					<textarea id="erh_loc_message" name="erh_message" rows="3" required></textarea>
				</div>

				<button type="submit" class="erh-btn erh-btn--gold erh-btn--lg erh-btn--block">
					<?php esc_html_e( 'Get My Free Estimate', 'elite-remodel-hub' ); ?>
				</button>
			</form>

		</div>

	</div>
</section>
