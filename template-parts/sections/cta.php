<?php
/**
 * Home section: Get Started CTA.
 *
 * Full-bleed photo band with a dark navy overlay, heading and text on the
 * left, a button on the right.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_bg    = erh_image( erh_field( 'cta_bg_image' ), 'erh-wide' );
$erh_title = erh_field( 'cta_title' );
$erh_text  = erh_field( 'cta_text' );

$erh_contact_url = erh_contact_page_url();

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#contact';
}

$erh_button_default = erh_default( 'cta_button' );

if ( ! is_array( $erh_button_default ) ) {
	$erh_button_default = array( 'url' => '', 'title' => '' );
}

// The estimate button points at the contact page unless a URL is set.
if ( empty( $erh_button_default['url'] ) ) {
	$erh_button_default['url'] = $erh_contact_url;
}

$erh_button = erh_resolved_link( erh_field( 'cta_button', $erh_button_default ), __( 'Contact Us', 'elite-remodel-hub' ) );
?>
<section class="erh-cta" id="get-started">

	<?php if ( $erh_bg['url'] ) : ?>
		<div class="erh-cta__bg" style="background-image:url('<?php echo esc_url( $erh_bg['url'] ); ?>');" aria-hidden="true"></div>
	<?php endif; ?>
	<div class="erh-cta__overlay" aria-hidden="true"></div>

	<div class="erh-container erh-cta__inner">

		<div class="erh-cta__content">
			<?php if ( $erh_title ) : ?>
				<h2 class="erh-cta__title"><?php echo esc_html( $erh_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $erh_text ) : ?>
				<p class="erh-cta__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_button ) : ?>
			<a class="erh-btn erh-btn--gold erh-btn--lg"<?php echo erh_link_attrs( $erh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
				<?php echo esc_html( $erh_button['title'] ); ?>
			</a>
		<?php endif; ?>

	</div>
</section>
