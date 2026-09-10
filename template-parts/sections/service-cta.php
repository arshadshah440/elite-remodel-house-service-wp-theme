<?php
/**
 * Service detail section: Get Started CTA.
 *
 * Same full-bleed photo band as the home page's Get Started CTA
 * (.erh-cta, home.css), but the title defaults to a line personalised with
 * this service's name when the field is left empty.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_bg = erh_image( get_post_thumbnail_id(), 'erh-wide' );

if ( ! $erh_bg['url'] ) {
	$erh_bg['url'] = erh_placeholder_image_url();
}

$erh_title = erh_field( 'service_cta_title' );

if ( ! $erh_title ) {
	/* translators: %s: service title, e.g. "Kitchen Remodeling". */
	$erh_title = sprintf( __( 'Ready to Start Your %s Project?', 'elite-remodel-hub' ), get_the_title() );
}

$erh_text = erh_field( 'service_cta_text' );

$erh_contact_url = erh_contact_page_url();

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#contact';
}

$erh_button_default = array(
	'url'   => $erh_contact_url,
	'title' => __( 'Get a Free Quote', 'elite-remodel-hub' ),
);

$erh_button = erh_link( erh_field( 'service_cta_button', $erh_button_default ), __( 'Get a Free Quote', 'elite-remodel-hub' ) );
?>
<section class="erh-cta" id="contact">

	<?php if ( $erh_bg['url'] ) : ?>
		<div class="erh-cta__bg" style="background-image:url('<?php echo esc_url( $erh_bg['url'] ); ?>');" aria-hidden="true"></div>
	<?php endif; ?>
	<div class="erh-cta__overlay" aria-hidden="true"></div>

	<div class="erh-container erh-cta__inner">

		<div class="erh-cta__content">
			<h2 class="erh-cta__title"><?php echo esc_html( $erh_title ); ?></h2>
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
