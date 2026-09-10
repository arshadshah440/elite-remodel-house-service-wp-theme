<?php
/**
 * Inline SVG icon library.
 *
 * Icons are drawn in the Tabler Icons style (MIT licensed) so they stay
 * colorable with `currentColor` and avoid extra HTTP requests.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Icon path data, keyed by icon slug.
 *
 * Each entry is a list of <path> `d` attributes drawn on a 24x24 grid.
 *
 * @return array<string, array<int, string>>
 */
function erh_icon_paths() {
	return array(
		// Brands.
		'facebook'  => array( 'M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3' ),
		'instagram' => array(
			'M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z',
			'M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0',
			'M16.5 7.5v.01',
		),
		'linkedin'  => array(
			'M8 11v5',
			'M8 8v.01',
			'M12 16v-5',
			'M16 16v-3a2 2 0 1 0 -4 0',
			'M3 7a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v10a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4z',
		),
		'youtube'   => array(
			'M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4z',
			'M10 9l5 3l-5 3z',
		),
		'x'         => array(
			'M4 4l11.733 16h4.267l-11.733 -16z',
			'M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772',
		),
		'pinterest' => array(
			'M8 20l4 -9',
			'M10.7 14c.437 1.263 1.43 2 2.55 2c2.071 0 3.75 -1.554 3.75 -4a5 5 0 1 0 -9.7 1.7',
			'M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0',
		),

		// Contact / UI.
		'phone'     => array( 'M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2' ),
		'mail'      => array(
			'M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z',
			'M3 7l9 6l9 -6',
		),
		'map-pin'   => array(
			'M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0',
			'M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z',
		),
		'clock'     => array(
			'M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0',
			'M12 7v5l3 3',
		),
		'arrow-right' => array(
			'M5 12l14 0',
			'M13 18l6 -6',
			'M13 6l6 6',
		),
		'arrow-up-right' => array(
			'M17 7l-10 10',
			'M8 7l9 0l0 9',
		),
		'chevron-down'  => array( 'M6 9l6 6l6 -6' ),
		'chevron-left'  => array( 'M15 6l-6 6l6 6' ),
		'chevron-right' => array( 'M9 6l6 6l-6 6' ),
		'check'     => array( 'M5 12l5 5l10 -10' ),
		'search'    => array(
			'M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0',
			'M21 21l-6 -6',
		),
		'x-close'   => array(
			'M18 6l-12 12',
			'M6 6l12 12',
		),
		'menu'      => array(
			'M4 6l16 0',
			'M4 12l16 0',
			'M4 18l16 0',
		),
		'quote'     => array(
			'M10 11h-4a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v4c0 3.5 -2 5.5 -4.5 5.5',
			'M20 11h-4a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v4c0 3.5 -2 5.5 -4.5 5.5',
		),
		'send'      => array(
			'M10 14l11 -11',
			'M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5',
		),

		// Feature / stat icons.
		'users'     => array(
			'M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0',
			'M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2',
			'M16 3.13a4 4 0 0 1 0 7.75',
			'M21 21v-2a4 4 0 0 0 -3 -3.85',
		),
		'award'     => array(
			'M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0',
			'M12.884 15.416l1.116 5.584l-3 -2l-3 2l1.116 -5.584',
		),
		'shield'    => array( 'M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3' ),
		'home'      => array(
			'M5 12l-2 0l9 -9l9 9l-2 0',
			'M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7',
			'M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6',
		),

		// Remodeling / craft icons.
		'hammer'      => array(
			'M14.5 5.5l4 4l-9.9 9.9c-.965 .965 -2.828 .612 -4.16 -.72c-1.331 -1.33 -1.684 -3.195 -.72 -4.159z',
			'M12 8.5l4 -4c.965 -.965 2.828 -.612 4.16 .72c1.331 1.33 1.684 3.195 .72 4.159l-4 4',
		),
		'ruler'       => array( 'M4 4h16v6h-16z', 'M8 4v3', 'M12 4v3', 'M16 4v3', 'M4 15h16v6h-16z', 'M8 15v3' ),
		'paint-roller' => array(
			'M4 3h12v6h-12z',
			'M7 9v9a2 2 0 0 0 4 0v-2a2 2 0 0 1 4 0v2',
			'M17 6h3v4h-3z',
		),
		'tool'      => array( 'M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5' ),
		'sparkles'  => array(
			'M12 3v4',
			'M12 17v4',
			'M3 12h4',
			'M17 12h4',
			'M6 6l2 2',
			'M16 6l-2 2',
			'M6 18l2 -2',
			'M16 18l-2 -2',
		),
		'calendar-check' => array(
			'M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z',
			'M16 3v4',
			'M8 3v4',
			'M4 11h16',
			'M9 16l2 2l4 -4',
		),
		'chat'      => array(
			'M8 9h8',
			'M8 13h6',
			'M12 20.5a1.5 1.5 0 0 1 -1.5 -1.5v-1a5.5 5.5 0 0 1 -5.5 -5.5v-4a5.5 5.5 0 0 1 5.5 -5.5h3a5.5 5.5 0 0 1 5.5 5.5v4a5.5 5.5 0 0 1 -5.5 5.5h-.5l-2 2z',
		),
		'target'    => array(
			'M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0',
			'M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0',
			'M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0',
		),
	);
}

/**
 * Build an inline SVG icon.
 *
 * @param string $name Icon slug, e.g. "phone".
 * @param array  $args Optional. {
 *     @type int    $size  Square pixel size. Default 24.
 *     @type string $class Extra CSS classes.
 *     @type string $label Accessible label. When empty the icon is hidden from AT.
 * }
 * @return string Escaped SVG markup, or an empty string when the icon is unknown.
 */
function erh_get_icon( $name, $args = array() ) {
	$name = sanitize_key( $name );

	if ( 'star' === $name ) {
		$svg_paths = array( 'M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z' );
		$filled    = true;
	} else {
		$icons = erh_icon_paths();

		if ( ! isset( $icons[ $name ] ) ) {
			return '';
		}

		$svg_paths = $icons[ $name ];
		$filled    = false;
	}

	$args = wp_parse_args(
		$args,
		array(
			'size'  => 24,
			'class' => '',
			'label' => '',
		)
	);

	$size    = absint( $args['size'] );
	$classes = trim( 'erh-icon erh-icon--' . $name . ' ' . $args['class'] );

	$attributes = array(
		'xmlns="http://www.w3.org/2000/svg"',
		'viewBox="0 0 24 24"',
		'width="' . esc_attr( $size ) . '"',
		'height="' . esc_attr( $size ) . '"',
		'class="' . esc_attr( $classes ) . '"',
	);

	if ( $filled ) {
		$attributes[] = 'fill="currentColor"';
		$attributes[] = 'stroke="none"';
	} else {
		$attributes[] = 'fill="none"';
		$attributes[] = 'stroke="currentColor"';
		$attributes[] = 'stroke-width="2"';
		$attributes[] = 'stroke-linecap="round"';
		$attributes[] = 'stroke-linejoin="round"';
	}

	if ( $args['label'] ) {
		$attributes[] = 'role="img"';
		$attributes[] = 'aria-label="' . esc_attr( $args['label'] ) . '"';
	} else {
		$attributes[] = 'aria-hidden="true"';
		$attributes[] = 'focusable="false"';
	}

	$markup = '<svg ' . implode( ' ', $attributes ) . '>';

	foreach ( $svg_paths as $path ) {
		$markup .= '<path d="' . esc_attr( $path ) . '"/>';
	}

	return $markup . '</svg>';
}

/**
 * Echo an inline SVG icon.
 *
 * @param string $name Icon slug.
 * @param array  $args See erh_get_icon().
 * @return void
 */
function erh_icon( $name, $args = array() ) {
	echo erh_get_icon( $name, $args ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- markup built and escaped in erh_get_icon().
}

/**
 * Guess an icon slug from a URL, used for the footer/header social links.
 *
 * @param string $url Social profile URL.
 * @return string Icon slug, defaults to "arrow-up-right".
 */
function erh_icon_from_url( $url ) {
	$host = strtolower( (string) wp_parse_url( $url, PHP_URL_HOST ) );

	$map = array(
		'facebook'  => 'facebook',
		'fb.com'    => 'facebook',
		'instagram' => 'instagram',
		'twitter'   => 'x',
		'x.com'     => 'x',
		'linkedin'  => 'linkedin',
		'youtube'   => 'youtube',
		'youtu.be'  => 'youtube',
		'pinterest' => 'pinterest',
	);

	foreach ( $map as $needle => $icon ) {
		if ( false !== strpos( $host, $needle ) ) {
			return $icon;
		}
	}

	return 'arrow-up-right';
}
