<?php
/**
 * The site header.
 *
 * Logo, primary navigation and the "Contact Us" CTA. Every string, image and
 * toggle below is editable in the admin under Theme Settings → Header
 * (Secure Custom Fields options page).
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_style = erh_option( 'header_style' );

$erh_header_classes = array( 'erh-header' );

if ( 'overlay' === $erh_style && is_front_page() ) {
	$erh_header_classes[] = 'erh-header--overlay';
} elseif ( 'sticky' === $erh_style ) {
	$erh_header_classes[] = 'erh-header--sticky';
} else {
	$erh_header_classes[] = 'erh-header--solid';
}

$erh_logo        = erh_header_logo_src();
$erh_logo_height = absint( erh_option( 'header_logo_height' ) );
$erh_logo_height = $erh_logo_height ? $erh_logo_height : 40;

$erh_header_contact_url = erh_contact_page_url();

if ( ! $erh_header_contact_url ) {
	$erh_header_contact_url = '#contact';
}

$erh_header_cta_default = array(
	'url'   => $erh_header_contact_url,
	'title' => __( 'Contact Us', 'elite-remodel-hub' ),
);

$erh_cta = erh_option( 'header_cta_enable' ) ? erh_link( erh_option( 'header_cta_link', $erh_header_cta_default ), __( 'Contact Us', 'elite-remodel-hub' ) ) : null;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#erh-content"><?php esc_html_e( 'Skip to content', 'elite-remodel-hub' ); ?></a>

<div id="page" class="erh-site">

	<header id="masthead" class="<?php echo esc_attr( implode( ' ', $erh_header_classes ) ); ?>">
		<div class="erh-container erh-header__inner">

			<?php // ---------------------------------------------------------- Branding ?>
			<a class="erh-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( $erh_logo['url'] ) : ?>
					<img
						class="erh-branding__logo"
						src="<?php echo esc_url( $erh_logo['url'] ); ?>"
						alt="<?php echo esc_attr( $erh_logo['alt'] ? $erh_logo['alt'] : get_bloginfo( 'name' ) ); ?>"
						style="height:<?php echo esc_attr( $erh_logo_height ); ?>px"
						decoding="async"
					>
				<?php else : ?>
					<span class="erh-branding__mark" aria-hidden="true">
						<?php erh_icon( 'home', array( 'size' => 20 ) ); ?>
					</span>
					<span class="erh-branding__text">
						<span class="erh-branding__name"><?php bloginfo( 'name' ); ?></span>
						<?php $erh_tagline = get_bloginfo( 'description', 'display' ); ?>
						<?php if ( $erh_tagline ) : ?>
							<span class="erh-branding__tagline"><?php echo esc_html( $erh_tagline ); ?></span>
						<?php endif; ?>
					</span>
				<?php endif; ?>
			</a>

			<?php // ---------------------------------------------------------- Navigation ?>
			<nav id="erh-primary-nav" class="erh-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'elite-remodel-hub' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'erh-primary-menu',
						'menu_class'     => 'erh-nav__list',
						'depth'          => 2,
						'fallback_cb'    => 'erh_fallback_menu',
					)
				);
				?>

				<?php if ( $erh_cta ) : ?>
					<div class="erh-nav__cta is-mobile">
						<a class="erh-btn erh-btn--gold"<?php echo erh_link_attrs( $erh_cta ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
							<?php echo esc_html( $erh_cta['title'] ); ?>
						</a>
					</div>
				<?php endif; ?>
			</nav>

			<?php // ---------------------------------------------------------- Actions ?>
			<div class="erh-header__actions">

				<?php if ( $erh_cta ) : ?>
					<a class="erh-btn erh-btn--gold"<?php echo erh_link_attrs( $erh_cta ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
						<?php echo esc_html( $erh_cta['title'] ); ?>
					</a>
				<?php endif; ?>

				<button
					class="erh-menu-toggle"
					type="button"
					aria-controls="erh-primary-nav"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'Open menu', 'elite-remodel-hub' ); ?>"
				>
					<span class="erh-menu-toggle__bars" aria-hidden="true"></span>
				</button>

			</div>

		</div>
	</header>

	<div id="erh-content" class="erh-site-content">
