<?php
/**
 * Location page section: Get Started CTA.
 *
 * Same full-bleed photo band as the home page's Get Started CTA (.erh-cta,
 * home.css), with the title defaulting to a line personalised with this
 * page's location name when left empty.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_bg = erh_image( erh_field( 'location_cta_bg_image' ), 'erh-wide' );

if ( ! $erh_bg['url'] ) {
	$erh_bg['url'] = erh_placeholder_image_url();
}

$erh_location = erh_field( 'location_name' );
$erh_title    = erh_field( 'location_cta_title' );

if ( ! $erh_title ) {
	/* translators: %s: location name, e.g. "Austin, TX". */
	$erh_title = sprintf( __( 'Get Your Free %s Remodeling Estimate Today', 'elite-remodel-hub' ), $erh_location );
}

$erh_text = erh_field( 'location_cta_text' );

$erh_contact_url = erh_contact_page_url();

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#quote';
}

$erh_button_default = array(
	'url'   => $erh_contact_url,
	'title' => __( 'Get a Free Quote', 'elite-remodel-hub' ),
);

$erh_button = erh_link( erh_field( 'location_cta_button', $erh_button_default ), __( 'Get a Free Quote', 'elite-remodel-hub' ) );
?>
<section class="erh-cta" id="get-started">

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
