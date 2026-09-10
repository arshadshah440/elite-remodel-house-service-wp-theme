<?php
/**
 * Contact page form handler.
 *
 * Plain wp_mail() over admin-post.php - no forms plugin required. Verifies
 * a nonce, checks a hidden honeypot field, sanitizes input, then redirects
 * back to the page it was submitted from with a `erh_contact` status flag
 * that template-parts/sections/contact-form.php reads to show a notice.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handle the contact form submission (logged in or logged out).
 *
 * @return void
 */
function erh_handle_contact_form() {
	$erh_redirect = isset( $_POST['erh_redirect'] ) ? esc_url_raw( wp_unslash( $_POST['erh_redirect'] ) ) : home_url( '/' );
	$erh_redirect = wp_validate_redirect( $erh_redirect, home_url( '/' ) );

	if (
		! isset( $_POST['erh_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['erh_contact_nonce'] ) ), 'erh_contact_form' )
	) {
		wp_safe_redirect( add_query_arg( 'erh_contact', 'error', $erh_redirect ) );
		exit;
	}

	// Honeypot: real visitors never fill this hidden field in.
	if ( ! empty( $_POST['erh_company'] ) ) {
		wp_safe_redirect( add_query_arg( 'erh_contact', 'success', $erh_redirect ) );
		exit;
	}

	$erh_name    = isset( $_POST['erh_name'] ) ? sanitize_text_field( wp_unslash( $_POST['erh_name'] ) ) : '';
	$erh_email   = isset( $_POST['erh_email'] ) ? sanitize_email( wp_unslash( $_POST['erh_email'] ) ) : '';
	$erh_phone   = isset( $_POST['erh_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['erh_phone'] ) ) : '';
	$erh_subject = isset( $_POST['erh_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['erh_subject'] ) ) : '';
	$erh_message = isset( $_POST['erh_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['erh_message'] ) ) : '';

	if ( ! $erh_name || ! is_email( $erh_email ) || ! $erh_message ) {
		wp_safe_redirect( add_query_arg( 'erh_contact', 'error', $erh_redirect ) );
		exit;
	}

	$erh_to = erh_option( 'brand_email' );
	$erh_to = ( $erh_to && is_email( $erh_to ) ) ? $erh_to : get_option( 'admin_email' );

	$erh_subject_line = $erh_subject
		? sprintf( '[%1$s] %2$s', get_bloginfo( 'name' ), $erh_subject )
		: sprintf(
			/* translators: %s: site name. */
			__( '[%s] New contact form message', 'elite-remodel-hub' ),
			get_bloginfo( 'name' )
		);

	$erh_body = implode(
		"\n",
		array_filter(
			array(
				sprintf( '%s: %s', __( 'Name', 'elite-remodel-hub' ), $erh_name ),
				sprintf( '%s: %s', __( 'Email', 'elite-remodel-hub' ), $erh_email ),
				$erh_phone ? sprintf( '%s: %s', __( 'Phone', 'elite-remodel-hub' ), $erh_phone ) : '',
				'',
				$erh_message,
			)
		)
	);

	$erh_headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %1$s <%2$s>', $erh_name, $erh_email ),
	);

	$erh_sent = wp_mail( $erh_to, $erh_subject_line, $erh_body, $erh_headers );

	wp_safe_redirect( add_query_arg( 'erh_contact', $erh_sent ? 'success' : 'error', $erh_redirect ) );
	exit;
}
add_action( 'admin_post_erh_contact_form', 'erh_handle_contact_form' );
add_action( 'admin_post_nopriv_erh_contact_form', 'erh_handle_contact_form' );
