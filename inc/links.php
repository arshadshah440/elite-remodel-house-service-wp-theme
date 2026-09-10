<?php
/**
 * Destination link helpers.
 *
 * The home page links out to a fixed set of service, guide and state pages
 * (see inc/seed-pages.php for the list). Rather than hard-coding absolute
 * URLs into templates or fields, every link is stored as a path such as
 * "/kitchen-remodeling/" and resolved at render time:
 *
 *   1. If a published page with that path exists, its permalink is used, so
 *      the link keeps working even after the permalink structure changes.
 *   2. Otherwise the path is appended to the site URL, so the link still
 *      points somewhere sensible before the page has been created.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Resolve a site-relative path to a full URL, preferring a real page.
 *
 * @param string $path Path such as "/kitchen-remodeling/" or "california".
 * @return string Absolute URL. Empty string when $path is empty.
 */
function erh_page_url( $path ) {
	$path = trim( (string) $path );

	if ( '' === $path ) {
		return '';
	}

	// Already absolute, or an in-page anchor - leave it alone.
	if ( preg_match( '#^(https?:)?//#i', $path ) || 0 === strpos( $path, '#' ) || 0 === strpos( $path, 'mailto:' ) || 0 === strpos( $path, 'tel:' ) ) {
		return $path;
	}

	$clean = trim( $path, '/' );

	if ( '' === $clean ) {
		return home_url( '/' );
	}

	static $cache = array();

	if ( isset( $cache[ $clean ] ) ) {
		return $cache[ $clean ];
	}

	$url  = '';
	$page = get_page_by_path( $clean, OBJECT, 'page' );

	if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
		$url = get_permalink( $page );
	}

	if ( ! $url ) {
		$url = home_url( '/' . $clean . '/' );
	}

	$cache[ $clean ] = $url;

	return $url;
}

/**
 * Normalise a link value that may be a path string, a plain URL or an
 * SCF/ACF link array, and resolve its URL through erh_page_url().
 *
 * @param mixed  $link          Link array, URL or path string.
 * @param string $default_title Fallback label.
 * @return array{url:string,title:string,target:string}|false
 */
function erh_resolved_link( $link, $default_title = '' ) {
	$link = erh_link( $link, $default_title );

	if ( ! $link ) {
		return false;
	}

	$link['url'] = erh_page_url( $link['url'] );

	return $link;
}

/**
 * Echo an anchor for a resolved link.
 *
 * @param mixed  $link          Link array, URL or path string.
 * @param string $default_title Fallback label.
 * @param string $class         CSS classes for the anchor.
 * @return void
 */
function erh_resolved_link_tag( $link, $default_title = '', $class = 'erh-btn erh-btn--navy' ) {
	$link = erh_resolved_link( $link, $default_title );

	if ( ! $link ) {
		return;
	}

	printf(
		'<a class="%1$s"%2$s>%3$s</a>',
		esc_attr( $class ),
		erh_link_attrs( $link ), // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs().
		esc_html( $link['title'] )
	);
}
