<?php
/**
 * Theme setup - supports, menus, image sizes, content width.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and navigation locations.
 *
 * @return void
 */
function erh_setup() {
	load_theme_textdomain( 'elite-remodel-hub', ERH_DIR . 'languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'appearance-tools' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'               => 60,
			'width'                => 200,
			'flex-height'          => true,
			'flex-width'           => true,
			'unlink-homepage-logo' => false,
		)
	);

	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);

	register_nav_menus(
		array(
			'primary'      => __( 'Primary Menu (header)', 'elite-remodel-hub' ),
			'footer_links' => __( 'Footer Quick Links', 'elite-remodel-hub' ),
			'footer_legal' => __( 'Footer Legal Links', 'elite-remodel-hub' ),
		)
	);

	// Editor palette mirrors the site's brand tokens.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Primary Navy', 'elite-remodel-hub' ),
				'slug'  => 'primary-navy',
				'color' => '#153A68',
			),
			array(
				'name'  => __( 'Accent Gold', 'elite-remodel-hub' ),
				'slug'  => 'accent-gold',
				'color' => '#F1B73E',
			),
			array(
				'name'  => __( 'Ink', 'elite-remodel-hub' ),
				'slug'  => 'ink',
				'color' => '#25262D',
			),
			array(
				'name'  => __( 'Grey', 'elite-remodel-hub' ),
				'slug'  => 'grey',
				'color' => '#666A73',
			),
			array(
				'name'  => __( 'Light Grey', 'elite-remodel-hub' ),
				'slug'  => 'light-grey',
				'color' => '#F7F6FF',
			),
			array(
				'name'  => __( 'White', 'elite-remodel-hub' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
		)
	);

	add_theme_support( 'disable-custom-colors' );

	add_image_size( 'erh-card', 620, 420, true );
	add_image_size( 'erh-service', 460, 460, true );
	add_image_size( 'erh-wide', 1440, 700, true );
	add_image_size( 'erh-blog', 460, 320, true );
	add_image_size( 'erh-blog-lg', 760, 560, true );
	add_image_size( 'erh-gallery', 460, 560, true );
	add_image_size( 'erh-compare', 900, 675, true );
}
add_action( 'after_setup_theme', 'erh_setup' );

/**
 * Set the content width in pixels.
 *
 * @return void
 */
function erh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'erh_content_width', 1280 );
}
add_action( 'after_setup_theme', 'erh_content_width', 0 );

/**
 * Allow administrators to upload SVG files, used for feature/service icons.
 *
 * Restricted to `manage_options` since SVGs can carry embedded script and
 * WordPress does not sanitise them on upload; the theme only ever renders
 * them via `<img src>`, which browsers do not execute as markup.
 *
 * @param array $mimes Allowed mime types, keyed by file extension.
 * @return array
 */
function erh_allow_svg_uploads( $mimes ) {
	if ( current_user_can( 'manage_options' ) ) {
		$mimes['svg'] = 'image/svg+xml';
	}

	return $mimes;
}
add_filter( 'upload_mimes', 'erh_allow_svg_uploads' );

/**
 * Confirm the real file type for SVG uploads so core's sniff check doesn't
 * reject them (SVGs fail the default finfo/getimagesize-based detection).
 *
 * @param array  $data     Sniffed file data.
 * @param string $file     Full path to the file.
 * @param string $filename The name of the file.
 * @param array  $mimes    Allowed mime types.
 * @return array
 */
function erh_fix_svg_filetype( $data, $file, $filename, $mimes ) {
	if ( ! empty( $data['ext'] ) && ! empty( $data['type'] ) ) {
		return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	if ( 'svg' === $filetype['ext'] ) {
		$data['ext']             = 'svg';
		$data['type']            = 'image/svg+xml';
		$data['proper_filename'] = $filename;
	}

	return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'erh_fix_svg_filetype', 10, 4 );

/**
 * Add useful classes to the body tag.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function erh_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_front_page() ) {
		$classes[] = 'erh-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'erh_body_classes' );

/**
 * Trim the excerpt to a friendlier length.
 *
 * @param int $length Default length.
 * @return int
 */
function erh_excerpt_length( $length ) {
	return is_admin() ? $length : 22;
}
add_filter( 'excerpt_length', 'erh_excerpt_length' );

/**
 * Replace the excerpt ellipsis.
 *
 * @return string
 */
function erh_excerpt_more() {
	return is_admin() ? '[&hellip;]' : '&hellip;';
}
add_filter( 'excerpt_more', 'erh_excerpt_more' );

/**
 * Drop the generic "Category:", "Tag:", "Archives:" etc. prefixes core adds
 * to archive titles.
 *
 * @param string $title Archive title with its default prefix.
 * @return string
 */
function erh_archive_title( $title ) {
	return preg_replace( '/^[^:]+:\s*/', '', $title );
}
add_filter( 'get_the_archive_title', 'erh_archive_title' );
