<?php
/**
 * Lightweight SEO output for the home page template.
 *
 * The Home Page Sections panel carries an "SEO" tab with a document title
 * and meta description. Both are only applied when no dedicated SEO plugin
 * is running, so installing Yoast, Rank Math, SEOPress or All in One SEO
 * later silently takes over instead of producing duplicate tags.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is a dedicated SEO plugin handling titles and meta descriptions?
 *
 * @return bool
 */
function erh_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'SEOPRESS_VERSION' )
		|| defined( 'AIOSEO_VERSION' )
		|| class_exists( 'The_SEO_Framework\\Load' );
}

/**
 * Should this request use the home page SEO fields?
 *
 * @return bool
 */
function erh_seo_applies() {
	if ( erh_seo_plugin_active() || is_admin() || is_feed() ) {
		return false;
	}

	return is_page_template( 'page-home.php' ) || ( is_front_page() && is_page() );
}

/**
 * Replace the document title with the SEO title field.
 *
 * @param array $parts Title parts.
 * @return array
 */
function erh_seo_document_title( $parts ) {
	if ( ! erh_seo_applies() ) {
		return $parts;
	}

	$title = trim( (string) erh_field( 'seo_title' ) );

	if ( ! $title ) {
		return $parts;
	}

	return array( 'title' => $title );
}
add_filter( 'document_title_parts', 'erh_seo_document_title' );

/**
 * Print the meta description tag.
 *
 * @return void
 */
function erh_seo_meta_description() {
	if ( ! erh_seo_applies() ) {
		return;
	}

	$description = trim( (string) erh_field( 'seo_description' ) );

	if ( ! $description ) {
		return;
	}

	printf(
		'<meta name="description" content="%s">' . "\n",
		esc_attr( wp_strip_all_tags( $description ) )
	);
}
add_action( 'wp_head', 'erh_seo_meta_description', 1 );
