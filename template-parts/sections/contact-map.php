<?php
/**
 * Contact page section: Map.
 *
 * A full-width embedded Google Map. Hidden entirely when no embed URL is
 * set, so the page still looks intentional without one.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_embed_url = erh_field( 'contact_map_embed_url' );

if ( ! $erh_embed_url ) {
	return;
}
?>
<section class="erh-contact-map">
	<iframe
		src="<?php echo esc_url( $erh_embed_url ); ?>"
		title="<?php esc_attr_e( 'Map showing our location', 'elite-remodel-hub' ); ?>"
		loading="lazy"
		referrerpolicy="no-referrer-when-downgrade"
		allowfullscreen
	></iframe>
</section>
