<?php
/**
 * Kitchen Gallery page section: Banner.
 *
 * Compact navy intro band with a breadcrumb, page title, intro text and a
 * primary call-to-action button - uses the same shared .erh-page-banner
 * styles (assets/css/pages.css) as the About, Contact, FAQ, Privacy Policy
 * and Service Listing pages.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_text = erh_field( 'gallery_banner_text' );

$erh_contact_url = erh_contact_page_url();

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#contact';
}

$erh_button = erh_resolved_link( erh_field( 'gallery_banner_button', array( 'url' => $erh_contact_url ) ), __( 'Plan Your Kitchen Remodel', 'elite-remodel-hub' ) );
?>
<section class="erh-page-banner">
	<div class="erh-container">

		<nav class="erh-page-banner__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'elite-remodel-hub' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'elite-remodel-hub' ); ?></a>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<?php erh_eyebrow( erh_field( 'gallery_banner_eyebrow' ) ); ?>

		<?php
		erh_split_heading(
			erh_field( 'gallery_banner_title' ),
			(int) erh_field( 'gallery_banner_title_highlight' ),
			'h1'
		);
		?>

		<?php if ( $erh_text ) : ?>
			<p class="erh-page-banner__text"><?php echo esc_html( $erh_text ); ?></p>
		<?php endif; ?>

		<?php if ( $erh_button ) : ?>
			<a class="erh-btn erh-btn--gold erh-btn--lg"<?php echo erh_link_attrs( $erh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
				<?php echo esc_html( $erh_button['title'] ); ?>
			</a>
		<?php endif; ?>

	</div>
</section>
